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
                log_message('debug', 'Profile picture is valid and has not been moved.');
                // Create directory if not exists
                if (create_upload_directory('profile_pictures')) {
                    log_message('debug', 'Upload directory created/exists.');
                } else {
                    log_message('error', 'Failed to create upload directory.');
                }
                
                $user = $this->userModel->find($userId);
                
                // Delete old profile picture if it exists
                if (!empty($user['profile_picture'])) {
                    if (delete_old_file($user['profile_picture'])) {
                        log_message('debug', 'Old profile picture deleted: ' . $user['profile_picture']);
                    } else {
                        log_message('error', 'Failed to delete old profile picture: ' . $user['profile_picture']);
                    }
                }
                
                $newName = $profilePicture->getRandomName();
                log_message('debug', 'New profile picture name: ' . $newName);
                if ($profilePicture->move(WRITEPATH . 'uploads/profile_pictures', $newName)) {
                    $userData['profile_picture'] = 'profile_pictures/' . $newName;
                    log_message('info', 'Profile picture uploaded successfully: ' . $newName);
                    log_message('debug', 'userData array after profile picture update: ' . json_encode($userData));
                } else {
                    log_message('error', 'Failed to move profile picture. Error: ' . $profilePicture->getErrorString());
                    throw new \Exception('Failed to move profile picture');
                }
            } else if ($profilePicture && $profilePicture->isValid()) {
                log_message('debug', 'Profile picture is valid but has already been moved or is not a valid upload.');
            } else if ($profilePicture) {
                log_message('debug', 'Profile picture is not valid. Error: ' . $profilePicture->getErrorString());
            } else {
                log_message('debug', 'No profile picture uploaded.');
            }

            // Handle license file upload
            $licenseFile = $this->request->getFile('license_file');
            if ($licenseFile && $licenseFile->isValid() && !$licenseFile->hasMoved()) {
                log_message('debug', 'License file is valid and has not been moved.');
                // Create directory if not exists
                if (create_upload_directory('therapist_documents')) {
                    log_message('debug', 'Therapist documents directory created/exists.');
                } else {
                    log_message('error', 'Failed to create therapist documents directory.');
                }
                
                $therapist = $this->therapistModel->where('user_id', $userId)->first();
                
                // Delete old license file if it exists
                if ($therapist && !empty($therapist->license_file)) {
                    if (delete_old_file($therapist->license_file)) {
                        log_message('debug', 'Old license file deleted: ' . $therapist->license_file);
                    } else {
                        log_message('error', 'Failed to delete old license file: ' . $therapist->license_file);
                    }
                }
                
                $newName = $licenseFile->getRandomName();
                log_message('debug', 'New license file name: ' . $newName);
                if ($licenseFile->move(WRITEPATH . 'uploads/therapist_documents', $newName)) {
                    $therapistData['license_file'] = 'therapist_documents/' . $newName;
                    $therapistData['verification_status'] = 'pending';
                    log_message('info', 'License file uploaded successfully: ' . $newName);
                    log_message('debug', 'therapistData array after license file update: ' . json_encode($therapistData));
                } else {
                    log_message('error', 'Failed to move license file. Error: ' . $licenseFile->getErrorString());
                    throw new \Exception('Failed to move license file');
                }
            } else if ($licenseFile && $licenseFile->isValid()) {
                log_message('debug', 'License file is valid but has already been moved or is not a valid upload.');
            } else if ($licenseFile) {
                log_message('debug', 'License file is not valid. Error: ' . $licenseFile->getErrorString());
            } else {
                log_message('debug', 'No license file uploaded.');
            }

            // Handle ID card file upload
            $idCardFile = $this->request->getFile('id_card_file');
            if ($idCardFile && $idCardFile->isValid() && !$idCardFile->hasMoved()) {
                log_message('debug', 'ID card file is valid and has not been moved.');
                // Create directory if not exists
                if (create_upload_directory('user_documents')) {
                    log_message('debug', 'User documents directory created/exists.');
                } else {
                    log_message('error', 'Failed to create user documents directory.');
                }
                
                $user = $this->userModel->find($userId);
                
                // Delete old ID card file if it exists
                if (!empty($user['id_card_file'])) {
                    if (delete_old_file($user['id_card_file'])) {
                        log_message('debug', 'Old ID card file deleted: ' . $user['id_card_file']);
                    } else {
                        log_message('error', 'Failed to delete old ID card file: ' . $user['id_card_file']);
                    }
                }
                
                $newName = $idCardFile->getRandomName();
                log_message('debug', 'New ID card file name: ' . $newName);
                if ($idCardFile->move(WRITEPATH . 'uploads/user_documents', $newName)) {
                    $userData['id_card_file'] = 'user_documents/' . $newName;
                    $therapistData['verification_status'] = 'pending';
                    log_message('info', 'ID card file uploaded successfully: ' . $newName);
                    log_message('debug', 'userData array after ID card file update: ' . json_encode($userData));
                } else {
                    log_message('error', 'Failed to move ID card file. Error: ' . $idCardFile->getErrorString());
                    throw new \Exception('Failed to move ID card file');
                }
            } else if ($idCardFile && $idCardFile->isValid()) {
                log_message('debug', 'ID card file is valid but has already been moved or is not a valid upload.');
            } else if ($idCardFile) {
                log_message('debug', 'ID card file is not valid. Error: ' . $idCardFile->getErrorString());
            } else {
                log_message('debug', 'No ID card file uploaded.');
            }

            log_message('debug', 'Final userData array before userModel update: ' . json_encode($userData));
            log_message('debug', 'Final therapistData array before therapistModel update: ' . json_encode($therapistData));

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