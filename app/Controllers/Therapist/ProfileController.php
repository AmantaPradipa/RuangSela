<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TherapistModel;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $therapistModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->therapistModel = new TherapistModel();
        
        // Load file helper
        helper('file_helper');
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $therapist = $this->therapistModel->where('user_id', $userId)->first();

        if (!$user) {
            return redirect()->to(base_url('login'))->with('error', 'Pengguna tidak ditemukan.');
        }

        // Ensure $therapist is an array with default values if not found
        if (!$therapist) {
            $therapist = [
                'expertise' => '',
                'experience_years' => 0,
                'education' => null, // Will be handled by json_decode later
                'license_number' => '',
                'bio' => '',
                'license_file' => '',
                'verification_status' => 'unregistered',
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        // Decode JSON fields if they exist and are not null
        // Ensure 'education' is an array for implode, even if null from DB
        $therapist['education'] = json_decode($therapist['education'] ?? '[]', true);
        // If json_decode returns null (e.g., invalid JSON), ensure it's an empty array
        if (!is_array($therapist['education'])) {
            $therapist['education'] = [];
        }

        $data = [
            'title' => 'Pengaturan Akun',
            'user' => $user,
            'therapist' => $therapist,
        ];
        return view('therapist/profile', $data);
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
            'expertise' => 'permit_empty',
            'experience_years' => 'permit_empty|numeric',
            'education' => 'permit_empty',
            'license_number' => 'permit_empty',
            'license_file' => 'permit_empty|max_size[license_file,2048]|ext_in[license_file,pdf,jpg,jpeg,png]',
            'id_card_file' => 'permit_empty|max_size[id_card_file,2048]|ext_in[id_card_file,pdf,jpg,jpeg,png]',
            'bio' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            log_message('error', 'Profile validation failed: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        $therapistData = [
            'expertise' => $this->request->getPost('expertise'),
            'experience_years' => $this->request->getPost('experience_years'),
            'education' => json_encode(array_map('trim', explode(',', $this->request->getPost('education')))),
            'license_number' => $this->request->getPost('license_number'),
            'bio' => $this->request->getPost('bio'),
        ];

        try {
            // Handle profile picture upload
            $profilePicture = $this->request->getFile('profile_picture');
            if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
                // Create directory if not exists
                create_upload_directory('profile_pictures');
                
                $user = $this->userModel->find($userId);
                
                // Delete old profile picture if it exists
                if (!empty($user['profile_picture'])) {
                    delete_old_file($user['profile_picture']);
                }
                
                $newName = $profilePicture->getRandomName();
                if ($profilePicture->move(WRITEPATH . 'uploads/profile_pictures', $newName)) {
                    $userData['profile_picture'] = 'profile_pictures/' . $newName;
                    log_message('info', 'Profile picture uploaded successfully: ' . $newName);
                } else {
                    throw new \Exception('Failed to move profile picture');
                }
            }

            // Handle license file upload
            $licenseFile = $this->request->getFile('license_file');
            if ($licenseFile && $licenseFile->isValid() && !$licenseFile->hasMoved()) {
                // Create directory if not exists
                create_upload_directory('therapist_documents');
                
                $therapist = $this->therapistModel->where('user_id', $userId)->first();
                
                // Delete old license file if it exists
                if ($therapist && !empty($therapist->license_file)) {
                    delete_old_file($therapist->license_file);
                }
                
                $newName = $licenseFile->getRandomName();
                if ($licenseFile->move(WRITEPATH . 'uploads/therapist_documents', $newName)) {
                    $therapistData['license_file'] = 'therapist_documents/' . $newName;
                    $therapistData['verification_status'] = 'pending';
                    log_message('info', 'License file uploaded successfully: ' . $newName);
                } else {
                    throw new \Exception('Failed to move license file');
                }
            }

            // Handle ID card file upload
            $idCardFile = $this->request->getFile('id_card_file');
            if ($idCardFile && $idCardFile->isValid() && !$idCardFile->hasMoved()) {
                // Create directory if not exists
                create_upload_directory('user_documents');
                
                $user = $this->userModel->find($userId);
                
                // Delete old ID card file if it exists
                if (!empty($user['id_card_file'])) {
                    delete_old_file($user['id_card_file']);
                }
                
                $newName = $idCardFile->getRandomName();
                if ($idCardFile->move(WRITEPATH . 'uploads/user_documents', $newName)) {
                    $userData['id_card_file'] = 'user_documents/' . $newName;
                    $therapistData['verification_status'] = 'pending';
                    log_message('info', 'ID card file uploaded successfully: ' . $newName);
                } else {
                    throw new \Exception('Failed to move ID card file');
                }
            }

            // Update user data
            if (!$this->userModel->update($userId, $userData)) {
                throw new \Exception('Failed to update user data');
            }

            // Update or create therapist data
            $therapist = $this->therapistModel->where('user_id', $userId)->first();
            if ($therapist) {
                if (!$this->therapistModel->update($therapist->id, $therapistData)) {
                    throw new \Exception('Failed to update therapist data');
                }
            } else {
                $therapistData['user_id'] = $userId;
                if (!$this->therapistModel->save($therapistData)) {
                    throw new \Exception('Failed to create therapist data');
                }
            }

            // Update session data
            $updatedUser = $this->userModel->find($userId);
            session()->set([
                'username' => $updatedUser['username'],
                'email' => $updatedUser['email'],
                'first_name' => $updatedUser['first_name'],
                'last_name' => $updatedUser['last_name'],
                'profile_picture' => $updatedUser['profile_picture']
            ]);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');

        } catch (\Exception $e) {
            log_message('error', 'Profile update error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}