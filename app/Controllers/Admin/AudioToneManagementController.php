<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AudioToneModel;

class AudioToneManagementController extends BaseController
{
    protected $audioToneModel;

    public function __construct()
    {
        $this->audioToneModel = new AudioToneModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Audio Tone',
            'audioTones' => $this->audioToneModel->findAll(),
        ];
        return view('admin/audio_tones/audio_tones_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Audio Tone Baru',
        ];
        return view('admin/audio_tones/create_audio_tone', $data);
    }

    public function save()
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'permit_empty',
            'frequency_hz' => 'required|numeric',
            'audio_file' => 'uploaded[audio_file]|max_size[audio_file,5000]|ext_in[audio_file,mp3,wav]',
            'is_public' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $audioFile = $this->request->getFile('audio_file');
        $filePath = null;
        if ($audioFile && $audioFile->isValid() && !$audioFile->hasMoved()) {
            $newName = $audioFile->getRandomName();
            $audioFile->move(WRITEPATH . 'uploads/audio_tones', $newName);
            $filePath = 'audio_tones/' . $newName;
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'frequency_hz' => $this->request->getPost('frequency_hz'),
            'file_path' => $filePath,
            'is_public' => $this->request->getPost('is_public'),
        ];

        if ($this->audioToneModel->save($data)) {
            return redirect()->to(base_url('admin/audio_tones'))->with('success', 'Audio Tone berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan Audio Tone.');
        }
    }

    public function edit($id)
    {
        $audioTone = $this->audioToneModel->find($id);

        if (!$audioTone) {
            return redirect()->back()->with('error', 'Audio Tone tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Audio Tone',
            'audioTone' => $audioTone,
        ];
        return view('admin/audio_tones/edit_audio_tone', $data);
    }

    public function update($id)
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'permit_empty',
            'frequency_hz' => 'required|numeric',
            'audio_file' => 'permit_empty|uploaded[audio_file]|max_size[audio_file,5000]|ext_in[audio_file,mp3,wav]',
            'is_public' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $audioTone = $this->audioToneModel->find($id);
        if (!$audioTone) {
            return redirect()->back()->with('error', 'Audio Tone tidak ditemukan.');
        }

        $filePath = $audioTone['file_path'];
        $audioFile = $this->request->getFile('audio_file');
        if ($audioFile && $audioFile->isValid() && !$audioFile->hasMoved()) {
            // Delete old file if exists
            if ($filePath && file_exists(WRITEPATH . 'uploads/' . $filePath)) {
                unlink(WRITEPATH . 'uploads/' . $filePath);
            }
            $newName = $audioFile->getRandomName();
            $audioFile->move(WRITEPATH . 'uploads/audio_tones', $newName);
            $filePath = 'audio_tones/' . $newName;
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'frequency_hz' => $this->request->getPost('frequency_hz'),
            'file_path' => $filePath,
            'is_public' => $this->request->getPost('is_public'),
        ];

        if ($this->audioToneModel->update($id, $data)) {
            return redirect()->to(base_url('admin/audio_tones'))->with('success', 'Audio Tone berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui Audio Tone.');
        }
    }

    public function delete($id)
    {
        $audioTone = $this->audioToneModel->find($id);

        if (!$audioTone) {
            return redirect()->back()->with('error', 'Audio Tone tidak ditemukan.');
        }

        if ($this->audioToneModel->delete($id)) {
            // Delete audio file
            if ($audioTone['file_path'] && file_exists(WRITEPATH . 'uploads/' . $audioTone['file_path'])) {
                unlink(WRITEPATH . 'uploads/' . $audioTone['file_path']);
            }
            return redirect()->back()->with('success', 'Audio Tone berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus Audio Tone.');
        }
    }
}
