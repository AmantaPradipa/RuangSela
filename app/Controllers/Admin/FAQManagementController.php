<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FAQModel;

class FAQManagementController extends BaseController
{
    protected $faqModel;

    public function __construct()
    {
        $this->faqModel = new FAQModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen FAQ',
            'faqs' => $this->faqModel->findAll(),
        ];
        return view('admin/faqs/faqs_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah FAQ Baru',
        ];
        return view('admin/faqs/create_faq', $data);
    }

    public function save()
    {
        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'category' => 'permit_empty',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'category' => $this->request->getPost('category'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        if ($this->faqModel->save($data)) {
            return redirect()->to(base_url('admin/faqs'))->with('success', 'FAQ berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan FAQ.');
        }
    }

    public function edit($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            return redirect()->back()->with('error', 'FAQ tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit FAQ',
            'faq' => $faq,
        ];
        return view('admin/faqs/edit_faq', $data);
    }

    public function update($id)
    {
        $rules = [
            'question' => 'required',
            'answer' => 'required',
            'category' => 'permit_empty',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'category' => $this->request->getPost('category'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        if ($this->faqModel->update($id, $data)) {
            return redirect()->to(base_url('admin/faqs'))->with('success', 'FAQ berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui FAQ.');
        }
    }

    public function delete($id)
    {
        if ($this->faqModel->delete($id)) {
            return redirect()->back()->with('success', 'FAQ berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus FAQ.');
        }
    }
}
