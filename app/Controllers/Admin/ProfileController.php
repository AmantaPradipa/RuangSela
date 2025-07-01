<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        
        // Load file helper
        helper('file_helper');
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to(base_url('login'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Pengaturan Akun Admin',
            'user' => $user,
        ];
        return view('admin/profile', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');

        $rules = [
            'first_name' => 'required|max_length[50]',
            'last_name' => 'permit_empty|max_length[50]',
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[50]|is_unique[users.username,id,' . $userId . ']',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $userId . ']',
            'profile_picture' => 'permit_empty|max_size[profile_picture,1024]|ext_in[profile_picture,jpg,jpeg,png]',
        ];

        if (!$this->validate($rules)) {
            log_message('error', 'Profile validation failed: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        // Handle profile picture upload
        $profilePicture = $this->request->getFile('profile_picture');
        
        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            try {
                // Create directory if not exists
                create_upload_directory('profile_pictures');
                
                $user = $this->userModel->find($userId);
                
                // Delete old profile picture if it exists
                if (!empty($user['profile_picture'])) {
                    delete_old_file($user['profile_picture']);
                }
                
                // Generate new filename
                $newName = $profilePicture->getRandomName();
                
                // Move file to upload directory
                if ($profilePicture->move(WRITEPATH . 'uploads/profile_pictures', $newName)) {
                    $data['profile_picture'] = 'profile_pictures/' . $newName;
                    log_message('info', 'Profile picture uploaded successfully: ' . $newName);
                } else {
                    log_message('error', 'Failed to move profile picture');
                    return redirect()->back()->withInput()->with('error', 'Gagal mengupload foto profil.');
                }
                
            } catch (\Exception $e) {
                log_message('error', 'Profile picture upload error: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupload foto profil.');
            }
        }

        try {
            if ($this->userModel->update($userId, $data)) {
                // Update session data if profile is updated
                $updatedUser = $this->userModel->find($userId);
                session()->set([
                    'username' => $updatedUser['username'],
                    'email' => $updatedUser['email'],
                    'first_name' => $updatedUser['first_name'],
                    'last_name' => $updatedUser['last_name'],
                    'profile_picture' => $updatedUser['profile_picture']
                ]);

                return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal memperbarui profil.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Profile update error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    }
}