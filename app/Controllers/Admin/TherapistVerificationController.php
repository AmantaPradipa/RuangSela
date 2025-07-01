<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TherapistModel;
use App\Models\UserModel;

class TherapistVerificationController extends BaseController
{
    protected $therapistModel;
    protected $userModel;

    public function __construct()
    {
        $this->therapistModel = new TherapistModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Verifikasi Terapis',
            'therapists' => $this->therapistModel->findAll(),
        ];
        return view('admin/therapists/verification_list', $data);
    }

    public function view($id)
    {
        $therapist = $this->therapistModel->find($id);

        if (!$therapist) {
            return redirect()->back()->with('error', 'Terapis tidak ditemukan.');
        }

        $user = $this->userModel->find($therapist->user_id);

        $data = [
            'title' => 'Detail Verifikasi Terapis',
            'therapist' => $therapist,
            'user' => $user,
        ];
        return view('admin/therapists/verification_detail', $data);
    }

    public function verify($id)
    {
        $therapist = $this->therapistModel->find($id);

        if (!$therapist) {
            return redirect()->back()->with('error', 'Terapis tidak ditemukan.');
        }

        $therapist->verification_status = 'verified';
        $therapist->verification_notes = $this->request->getPost('verification_notes');

        if ($this->therapistModel->save($therapist)) {
            // Optionally activate the user account if not already active
            $user = $this->userModel->find($therapist->user_id);
            if ($user && !$user['is_active']) {
                $this->userModel->update($user['id'], ['is_active' => 1]);
            }
            return redirect()->to(base_url('admin/therapists/verification'))->with('success', 'Terapis berhasil diverifikasi.');
        } else {
            return redirect()->back()->with('error', 'Gagal memverifikasi terapis.');
        }
    }

    public function reject($id)
    {
        $therapist = $this->therapistModel->find($id);

        if (!$therapist) {
            return redirect()->back()->with('error', 'Terapis tidak ditemukan.');
        }

        $therapist->verification_status = 'rejected';
        $therapist->verification_notes = $this->request->getPost('verification_notes');

        if ($this->therapistModel->save($therapist)) {
            return redirect()->to(base_url('admin/therapists/verification'))->with('success', 'Verifikasi terapis ditolak.');
        } else {
            return redirect()->back()->with('error', 'Gagal menolak verifikasi terapis.');
        }
    }
}
