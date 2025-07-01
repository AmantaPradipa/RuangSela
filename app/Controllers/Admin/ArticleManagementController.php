<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\UserModel;

class ArticleManagementController extends BaseController
{
    protected $articleModel;
    protected $userModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->userModel = new UserModel();
    }

    public function adminArticleIndex()
    {
        $data = [
            'title' => 'Manajemen Artikel',
            'articles' => $this->articleModel->findAll(),
        ];
        return view('admin/articles/articles_list', $data);
    }

    public function adminArticleCreate()
    {
        $data = [
            'title' => 'Tambah Artikel Baru',
            'authors' => $this->userModel->where('role', 'therapist')->orWhere('role', 'admin')->findAll(),
        ];
        return view('admin/articles/create_article', $data);
    }

    public function adminArticleSave()
    {
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required|min_length[20]',
            'excerpt' => 'permit_empty|max_length[500]',
            'featured_image' => 'permit_empty|uploaded[featured_image]|max_size[featured_image,1024]|ext_in[featured_image,jpg,jpeg,png,gif]',
            'is_published' => 'required|in_list[0,1]',
            'author_id' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $featuredImage = $this->request->getFile('featured_image');
        $imagePath = null;
        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            $newName = $featuredImage->getRandomName();
            $featuredImage->move(WRITEPATH . 'uploads/articles', $newName);
            $imagePath = 'articles/' . $newName;
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'featured_image' => $imagePath,
            'is_published' => $this->request->getPost('is_published'),
            'author_id' => $this->request->getPost('author_id'),
        ];

        if ($this->articleModel->save($data)) {
            return redirect()->to(base_url('admin/articles'))->with('success', 'Artikel berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan artikel.');
        }
    }

    public function adminArticleEdit($id)
    {
        $article = $this->articleModel->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Artikel',
            'article' => $article,
            'authors' => $this->userModel->where('role', 'therapist')->orWhere('role', 'admin')->findAll(),
        ];
        return view('admin/articles/edit_article', $data);
    }

    public function adminArticleUpdate($id)
    {
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required|min_length[20]',
            'excerpt' => 'permit_empty|max_length[500]',
            'featured_image' => 'permit_empty|uploaded[featured_image]|max_size[featured_image,1024]|ext_in[featured_image,jpg,jpeg,png,gif]',
            'is_published' => 'required|in_list[0,1]',
            'author_id' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $article = $this->articleModel->find($id);
        if (!$article) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        $imagePath = $article['featured_image'];
        $featuredImage = $this->request->getFile('featured_image');
        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            // Delete old image if exists
            if ($imagePath && file_exists(WRITEPATH . 'uploads/' . $imagePath)) {
                unlink(WRITEPATH . 'uploads/' . $imagePath);
            }
            $newName = $featuredImage->getRandomName();
            $featuredImage->move(WRITEPATH . 'uploads/articles', $newName);
            $imagePath = 'articles/' . $newName;
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'featured_image' => $imagePath,
            'is_published' => $this->request->getPost('is_published'),
            'author_id' => $this->request->getPost('author_id'),
        ];

        if ($this->articleModel->update($id, $data)) {
            return redirect()->to(base_url('admin/articles'))->with('success', 'Artikel berhasil diperbarui!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui artikel.');
        }
    }

    public function adminArticleDelete($id)
    {
        $article = $this->articleModel->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        if ($this->articleModel->delete($id)) {
            // Delete featured image file
            if ($article['featured_image'] && file_exists(WRITEPATH . 'uploads/' . $article['featured_image'])) {
                unlink(WRITEPATH . 'uploads/' . $article['featured_image']);
            }
            return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus artikel.');
        }
    }
}
