<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PackageModel;

class UserManagementController extends BaseController
{
    protected $userModel;
    protected $packageModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->packageModel = new PackageModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $this->userModel->findAll(),
        ];
        return view('admin/users/users_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengguna Baru',
            'packages' => $this->packageModel->findAll(),
        ];
        return view('admin/users/create_user', $data);
    }

    public function save()
    {
        $rules = [
            'first_name' => 'required|max_length[50]',
            'last_name' => 'permit_empty|max_length[50]',
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[50]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role' => 'required|in_list[client,therapist,admin]',
            'is_active' => 'required|in_list[0,1]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        if ($this->userModel->save($data)) {
            return redirect()->to(base_url('admin/users'))->with('success', 'Pengguna berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pengguna.');
        }
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Pengguna',
            'user' => $user,
            'packages' => $this->packageModel->findAll(),
        ];
        return view('admin/users/edit_user', $data);
    }

    public function update($id)
    {
        $rules = [
            'first_name' => 'required|max_length[50]',
            'last_name' => 'permit_empty|max_length[50]',
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[50]|is_unique[users.username,id,' . $id . ']',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'role' => 'required|in_list[client,therapist,admin]',
            'is_active' => 'required|in_list[0,1]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        if ($this->userModel->update($id, $data)) {
            return redirect()->to(base_url('admin/users'))->with('success', 'Pengguna berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui pengguna.');
        }
    }

    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            return redirect()->to(base_url('admin/users'))->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus pengguna.');
        }
    }
}
