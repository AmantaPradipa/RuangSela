<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\UserModel;

class AppointmentController extends BaseController
{
    protected $appointmentModel;
    protected $userModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $therapistId = session()->get('therapist_id'); // Assuming therapist_id is stored in session

        $appointments = $this->appointmentModel
                            ->select('appointments.*, users.first_name as client_first_name, users.last_name as client_last_name')
                            ->join('users', 'users.id = appointments.client_id')
                            ->where('appointments.therapist_id', $therapistId)
                            ->orderBy('scheduled_at', 'DESC')
                            ->findAll();

        $data = [
            'title' => 'Janji Temu',
            'appointments' => $appointments,
        ];
        return view('therapist/appointments/appointments_list', $data);
    }

    public function joinSession($appointmentId)
    {
        $appointment = $this->appointmentModel->find($appointmentId);

        if (!$appointment || $appointment->therapist_id !== session()->get('therapist_id')) {
            return redirect()->back()->with('error', 'Janji temu tidak ditemukan atau Anda tidak memiliki izin.');
        }

        // Redirect to the meeting link
        return redirect()->to($appointment->meeting_link);
    }
}
