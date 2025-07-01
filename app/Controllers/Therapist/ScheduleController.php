<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;
use App\Models\TherapistScheduleModel;
use App\Models\TherapistModel;
use CodeIgniter\I18n\Time;

class ScheduleController extends BaseController
{
    protected $therapistScheduleModel;
    protected $therapistModel;

    public function __construct()
    {
        $this->therapistScheduleModel = new TherapistScheduleModel();
        $this->therapistModel = new TherapistModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $therapist = $this->therapistModel->where('user_id', $userId)->first();

        if (!$therapist) {
            return redirect()->back()->with('error', 'Profil terapis tidak ditemukan.');
        }

        $data = [
            'title' => 'Kelola Jadwal',
            'schedules' => $this->therapistScheduleModel->where('therapist_id', $therapist->id)->findAll(),
        ];
        return view('therapist/schedule/manage_schedule', $data);
    }

    public function saveSchedule()
    {
        $rules = [
            'day_of_week' => 'required|in_list[Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday]',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_available' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');
        $therapist = $this->therapistModel->where('user_id', $userId)->first();

        if (!$therapist) {
            return redirect()->back()->with('error', 'Profil terapis tidak ditemukan.');
        }

        $data = [
            'therapist_id' => $therapist->id,
            'day_of_week' => $this->request->getPost('day_of_week'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'is_available' => $this->request->getPost('is_available'),
        ];

        // Check if schedule for this day already exists, then update, else insert
        $existingSchedule = $this->therapistScheduleModel
                                ->where('therapist_id', $therapist->id)
                                ->where('day_of_week', $data['day_of_week'])
                                ->first();

        if ($existingSchedule) {
            $this->therapistScheduleModel->update($existingSchedule->id, $data);
        } else {
            $this->therapistScheduleModel->save($data);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function deleteSchedule($id)
    {
        $userId = session()->get('user_id');
        $therapist = $this->therapistModel->where('user_id', $userId)->first();

        if (!$therapist) {
            return redirect()->back()->with('error', 'Profil terapis tidak ditemukan.');
        }

        $schedule = $this->therapistScheduleModel->find($id);

        if ($schedule && $schedule->therapist_id == $therapist->id) {
            $this->therapistScheduleModel->delete($id);
            return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
        }
    }
}
