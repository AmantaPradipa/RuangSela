<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url', 'auth_helper']);
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Masuk',
        ];
        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $user = $this->userModel->where('email', $email)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            session()->setFlashdata('error', 'Email atau kata sandi salah.');
            return redirect()->back()->withInput();
        }

        if (! $user['is_active']) {
            session()->setFlashdata('error', 'Akun Anda belum aktif. Silakan hubungi administrator.');
            return redirect()->back()->withInput();
        }

        $this->setUserSession($user);

        if ($remember) {
            // Implement remember me functionality if needed
        }

        return redirect()->to(base_url('dashboard'));
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Daftar',
        ];
        return view('auth/register', $data);
    }

    public function attemptRegister()
    {
        $rules = [
            'first_name'    => 'required|max_length[50]',
            'last_name'     => 'permit_empty|max_length[50]',
            'username'      => 'required|alpha_numeric_space|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[8]',
            'tos'           => 'required',
            
        ];

        $messages = [
            'tos' => [
                'required' => 'Anda harus menyetujui Syarat & Ketentuan.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => $this->request->getPost('password'), // Hashing handled by UserModel beforeInsert
            'is_verified'=> 0, // Default to unverified
            'is_active'  => 1, // Default to active, can be changed for email verification flow
            
        ];

        if (! $this->userModel->save($data)) {
            session()->setFlashdata('error', 'Gagal mendaftar. Silakan coba lagi.');
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        session()->setFlashdata('success', 'Pendaftaran berhasil! Silakan pilih peran Anda.');
        session()->set('registration_user_id', $this->userModel->getInsertID());

        return redirect()->to(base_url('select-role'));
    }

    public function selectRole()
    {
        if (! session()->has('registration_user_id')) {
            return redirect()->to(base_url('register'))->with('error', 'Silakan daftar terlebih dahulu.');
        }

        $data = [
            'title' => 'Pilih Peran',
        ];
        return view('auth/role_selection', $data);
    }

    public function attemptRoleSelection()
    {
        $rules = [
            'role' => 'required|in_list[client,therapist]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('registration_user_id');
        $role = $this->request->getPost('role');

        $user = $this->userModel->find($userId);

        if (! $user) {
            session()->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to(base_url('register'));
        }

        $this->userModel->update($userId, ['role' => $role]);

        // Log in the user after role selection
        $user['role'] = $role; // Update role in user array for session
        $this->setUserSession($user);

        session()->remove('registration_user_id');
        session()->setFlashdata('success', 'Peran Anda berhasil dipilih dan Anda telah masuk!');

        return redirect()->to(base_url('dashboard'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar.');
    }

    protected function setUserSession($user)
    {
        $sessionData = [
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'first_name' => $user['first_name'],
            'last_name'  => $user['last_name'],
            'role'       => $user['role'],
            'isLoggedIn' => true,
        ];
        session()->set($sessionData);
    }

    public function forgotPassword()
    {
        $data = [
            'title' => 'Lupa Kata Sandi',
        ];
        return view('auth/forgot_password', $data);
    }

    public function attemptForgotPassword()
    {
        // Placeholder for forgot password logic
        session()->setFlashdata('success', 'Jika email Anda terdaftar, tautan reset kata sandi telah dikirim.');
        return redirect()->back();
    }
}
