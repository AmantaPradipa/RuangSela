<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SystemSettingModel;

class SystemSettingController extends BaseController
{
    protected $systemSettingModel;

    public function __construct()
    {
        $this->systemSettingModel = new SystemSettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Sistem',
            'settings' => $this->systemSettingModel->findAll(),
        ];
        return view('admin/settings/system_settings', $data);
    }

    public function save()
    {
        $rules = [
            'setting_key' => 'required|max_length[100]|is_unique[system_settings.setting_key]',
            'setting_value' => 'required',
            'description' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'setting_key' => $this->request->getPost('setting_key'),
            'setting_value' => $this->request->getPost('setting_value'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->systemSettingModel->save($data)) {
            return redirect()->to(base_url('admin/settings'))->with('success', 'Pengaturan berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pengaturan.');
        }
    }

    public function update($key)
    {
        $rules = [
            'setting_value' => 'required',
            'description' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'setting_value' => $this->request->getPost('setting_value'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->systemSettingModel->update($key, $data)) {
            return redirect()->to(base_url('admin/settings'))->with('success', 'Pengaturan berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui pengaturan.');
        }
    }

    public function delete($key)
    {
        if ($this->systemSettingModel->delete($key)) {
            return redirect()->back()->with('success', 'Pengaturan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus pengaturan.');
        }
    }
}
