<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PackageModel;

class PackageManagementController extends BaseController
{
    protected $packageModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Paket Konsultasi',
            'packages' => $this->packageModel->findAll(),
        ];
        return view('admin/packages/packages_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Paket Baru',
        ];
        return view('admin/packages/create_package', $data);
    }

    public function save()
    {
        $rules = [
            'name' => 'required|max_length[255]',
            'description' => 'permit_empty',
            'price' => 'required|numeric',
            'sessions_count' => 'required|numeric',
            'features' => 'permit_empty',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $features = $this->request->getPost('features');
        $featuresArray = array_map('trim', explode(',', $features));

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'sessions_count' => $this->request->getPost('sessions_count'),
            'features' => $featuresArray,
            'is_active' => $this->request->getPost('is_active'),
        ];

        if ($this->packageModel->save($data)) {
            return redirect()->to(base_url('admin/packages'))->with('success', 'Paket berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan paket.');
        }
    }

    public function edit($id)
    {
        $package = $this->packageModel->find($id);

        if (!$package) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Paket',
            'package' => $package,
        ];
        return view('admin/packages/edit_package', $data);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|max_length[255]',
            'description' => 'permit_empty',
            'price' => 'required|numeric',
            'sessions_count' => 'required|numeric',
            'features' => 'permit_empty',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $features = $this->request->getPost('features');
        $featuresArray = array_map('trim', explode(',', $features));

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'sessions_count' => $this->request->getPost('sessions_count'),
            'features' => $featuresArray,
            'is_active' => $this->request->getPost('is_active'),
        ];

        if ($this->packageModel->update($id, $data)) {
            return redirect()->to(base_url('admin/packages'))->with('success', 'Paket berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui paket.');
        }
    }

    public function delete($id)
    {
        if ($this->packageModel->delete($id)) {
            return redirect()->to(base_url('admin/packages'))->with('success', 'Paket berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus paket.');
        }
    }
}
