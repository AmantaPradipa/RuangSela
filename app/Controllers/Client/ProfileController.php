<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        
        // Memuat helper yang dibutuhkan
        helper(['file_helper', 'form']);
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to(base_url('login'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Pengaturan Akun',
            'user' => $user,
            'validation' => \Config\Services::validation() // Mengirimkan validation service ke view
        ];
        return view('client/profile', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to(base_url('login'))->with('error', 'Pengguna tidak ditemukan.');
        }

        // Aturan validasi
        $rules = [
            'first_name' => 'required|string|max_length[50]',
            'last_name'  => 'permit_empty|string|max_length[50]',
            'phone'      => 'permit_empty|alpha_numeric_punct|max_length[15]',
            'address'    => 'permit_empty|string|max_length[255]',
            'profile_picture' => [
                'label' => 'Profile Picture',
                'rules' => 'is_image[profile_picture]'
                    . '|mime_in[profile_picture,image/jpg,image/jpeg,image/png]'
                    . '|max_size[profile_picture,2048]', // max 2MB
            ],
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke halaman profil dengan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari request
        $dataToUpdate = [
            'id'          => $userId,
            'first_name'  => $this->request->getPost('first_name'),
            'last_name'   => $this->request->getPost('last_name'),
            'phone'       => $this->request->getPost('phone'),
            'address'     => $this->request->getPost('address'),
        ];

        // Proses upload gambar profil jika ada
        $profilePicFile = $this->request->getFile('profile_picture');

        if ($profilePicFile && $profilePicFile->isValid() && !$profilePicFile->hasMoved()) {
            // Definisikan direktori upload
            $uploadPath = 'profile_pictures';
            
            // Buat direktori jika belum ada menggunakan helper
            create_upload_directory($uploadPath);

            // Hapus file lama jika ada menggunakan helper
            delete_old_file($user['profile_picture']);

            // Buat nama file acak baru
            $newName = $profilePicFile->getRandomName();
            
            // Pindahkan file ke direktori tujuan
            $profilePicFile->move(WRITEPATH . 'uploads/' . $uploadPath, $newName);

            // Simpan path file baru ke data yang akan diupdate
            $dataToUpdate['profile_picture'] = $uploadPath . '/' . $newName;
        }

        // Lakukan update ke database
        if ($this->userModel->save($dataToUpdate)) {
            // Update session data if profile is updated
            $updatedUser = $this->userModel->find($userId);
            session()->set([
                'username' => $updatedUser['username'],
                'email' => $updatedUser['email'],
                'first_name' => $updatedUser['first_name'],
                'last_name' => $updatedUser['last_name'],
                'profile_picture' => $updatedUser['profile_picture']
            ]);
            log_message('debug', 'Session profile_picture after update: ' . session()->get('profile_picture'));

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui profil.');
        }
    }
}
