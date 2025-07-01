<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\TherapistModel;
use App\Models\TherapistScheduleModel;
use CodeIgniter\I18n\Time;

class AppointmentController extends BaseController
{
    protected $appointmentModel;
    protected $therapistModel;
    protected $therapistScheduleModel;
    protected $transactionModel;
    protected $packageModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->therapistModel = new TherapistModel();
        $this->therapistScheduleModel = new TherapistScheduleModel();
        $this->transactionModel = new \App\Models\TransactionModel();
        $this->packageModel = new \App\Models\PackageModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $appointments = $this->appointmentModel
                            ->select('appointments.*, users.first_name as therapist_first_name, users.last_name as therapist_last_name')
                            ->join('therapists', 'therapists.id = appointments.therapist_id', 'left')
                            ->join('users', 'users.id = therapists.user_id', 'left')
                            ->where('appointments.client_id', $userId)
                            ->orderBy('scheduled_at', 'DESC')
                            ->findAll();

        // Ensure therapist_first_name and therapist_last_name are not null
        foreach ($appointments as &$appointment) {
            $appointment->therapist_first_name = $appointment->therapist_first_name ?? '';
            $appointment->therapist_last_name = $appointment->therapist_last_name ?? '';
        }

        $data = [
            'title' => 'Daftar Janji Temu',
            'appointments' => $appointments,
        ];
        return view('client/appointments/appointments_list', $data);
    }

    public function book($therapistId = null)
    {
        $therapist = null;
        $schedules = [];

        if ($therapistId) {
            $therapist = $this->therapistModel->find($therapistId);
            if ($therapist) {
                $schedules = $this->therapistScheduleModel->getSchedulesByTherapist($therapistId);
            }
        }

        $data = [
            'title' => 'Buat Janji Temu',
            'therapist' => $therapist,
            'schedules' => $schedules,
        ];
        return view('client/appointments/book_appointment', $data);
    }

    public function saveAppointment()
    {
        $rules = [
            'therapist_id' => 'required|numeric',
            'scheduled_at' => 'required|valid_date',
            'duration_minutes' => 'required|numeric',
            'package_id' => 'required|numeric', // Assuming package is selected before booking
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');
        $therapistId = $this->request->getPost('therapist_id');
        $scheduledAt = $this->request->getPost('scheduled_at');
        $durationMinutes = $this->request->getPost('duration_minutes');
        $packageId = $this->request->getPost('package_id');

        // 1. Check for active package and remaining sessions
        $activeTransaction = $this->transactionModel
                                ->where('user_id', $userId)
                                ->where('package_id', $packageId)
                                ->where('status', 'completed')
                                ->first();

        if (!$activeTransaction) {
            return redirect()->back()->with('error', 'Anda tidak memiliki paket aktif yang sesuai untuk booking ini.');
        }

        $packageDetails = $this->packageModel->find($activeTransaction['package_id']);
        if (!$packageDetails) {
            return redirect()->back()->with('error', 'Detail paket tidak ditemukan.');
        }

        $sessionsRemaining = $packageDetails['sessions_count'] - $activeTransaction['sessions_used'];

        if ($sessionsRemaining <= 0) {
            return redirect()->back()->with('error', 'Sesi Anda telah habis. Silakan beli paket baru.');
        }

        // Basic check for therapist availability (more complex logic needed for real-world)
        $isAvailable = $this->therapistScheduleModel
                            ->where('therapist_id', $therapistId)
                            ->where('day_of_week', Time::parse($scheduledAt)->format('l'))
                            ->where('start_time <=', Time::parse($scheduledAt)->format('H:i:s'))
                            ->where('end_time >=', Time::parse($scheduledAt)->addMinutes($durationMinutes)->format('H:i:s'))
                            ->where('is_available', 1)
                            ->first();

        if (!$isAvailable) {
            return redirect()->back()->with('error', 'Terapis tidak tersedia pada waktu yang dipilih.');
        }

        // Generate a unique meeting link
        $meetingLink = 'https://meet.google.com/' . uniqid();

        $data = [
            'client_id' => $userId,
            'therapist_id' => $therapistId,
            'package_id' => $packageId,
            'scheduled_at' => $scheduledAt,
            'duration_minutes' => $durationMinutes,
            'status' => 'scheduled',
            'meeting_link' => $meetingLink,
        ];

        if ($this->appointmentModel->save($data)) {
            // Decrement session count in the transaction
            $this->transactionModel->update($activeTransaction['id'], ['sessions_used' => $activeTransaction['sessions_used'] + 1]);
            return redirect()->to(base_url('client/appointments'))->with('success', 'Janji temu berhasil dibuat!');
        } else {
            return redirect()->back()->with('error', 'Gagal membuat janji temu.');
        }
    }

    public function prepareSession($appointmentId)
    {
        $appointment = $this->appointmentModel->find($appointmentId);

        if (!$appointment || $appointment->client_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Janji temu tidak ditemukan atau Anda tidak memiliki izin.');
        }

        // Check if it's 15 minutes before the session
        $scheduledTime = Time::parse($appointment->scheduled_at);
        $currentTime = Time::now();
        $diff = $scheduledTime->difference($currentTime);

        if ($diff->getMinutes() <= 15 && $diff->getDirection() === 'future') {
            // It's within 15 minutes before the session, redirect to audio page
            return redirect()->to(base_url('client/appointments/audio-prepare/' . $appointmentId));
        } elseif ($diff->getDirection() === 'past') {
            // Session has already passed, redirect directly to join session or a message
            return redirect()->to($appointment->meeting_link);
        } else {
            // Too early, show a message or redirect back
            return redirect()->back()->with('error', 'Sesi akan dimulai dalam waktu kurang dari 15 menit. Silakan coba lagi nanti.');
        }
    }

    public function audioPrepare($appointmentId)
    {
        $appointment = $this->appointmentModel->find($appointmentId);

        if (!$appointment || $appointment->client_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Janji temu tidak ditemukan atau Anda tidak memiliki izin.');
        }

        $data = [
            'title' => 'Persiapan Sesi',
            'appointment' => $appointment,
            'audio_file' => base_url('assets/audio/pure_tones/432hz.mp3'), // Specific 432Hz audio
        ];
        return view('client/appointments/audio_prepare', $data);
    }

    public function joinSession($appointmentId)
    {
        $appointment = $this->appointmentModel->find($appointmentId);

        if (!$appointment || $appointment->client_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Janji temu tidak ditemukan atau Anda tidak memiliki izin.');
        }

        // Redirect to the meeting link
        return redirect()->to($appointment->meeting_link);
    }
}
