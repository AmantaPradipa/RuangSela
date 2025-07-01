<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\UserModel;

class ArticleController extends BaseController
{
    protected $articleModel;
    protected $userModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->userModel = new UserModel();
    }

    public function therapistArticlesIndex()
    {
        $userId = session()->get('user_id');
        $data = [
            'title' => 'Manajemen Artikel',
            'articles' => $this->articleModel->where('author_id', $userId)->orderBy('created_at', 'DESC')->findAll(),
            'user' => $this->userModel->find($userId),
        ];
        return view('therapist/articles/articles_list', $data);
    }

    public function therapistArticlesCreate()
    {
        $data = [
            'title' => 'Buat Artikel Baru',
        ];
        return view('therapist/articles/create_article', $data);
    }

    public function therapistArticlesSave()
    {
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required|min_length[20]',
            'excerpt' => 'permit_empty|max_length[500]',
            'featured_image' => 'permit_empty|uploaded[featured_image]|max_size[featured_image,1024]|ext_in[featured_image,jpg,jpeg,png,gif]',
            'is_published' => 'permit_empty|in_list[0,1]',
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
            'author_id' => session()->get('user_id'),
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'featured_image' => $imagePath,
            'is_published' => $this->request->getPost('is_published') ?? 0,
        ];

        if ($this->articleModel->save($data)) {
            return redirect()->to(base_url('therapist/articles'))->with('success', 'Artikel berhasil disimpan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan artikel.');
        }
    }

    public function therapistArticlesEdit($id)
    {
        $article = $this->articleModel->find($id);

        if (!$article || $article['author_id'] !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan atau Anda tidak memiliki izin.');
        }

        $data = [
            'title' => 'Edit Artikel',
            'article' => $article,
        ];
        return view('therapist/articles/edit_article', $data);
    }

    public function therapistArticlesUpdate($id)
    {
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required|min_length[20]',
            'excerpt' => 'permit_empty|max_length[500]',
            'featured_image' => 'permit_empty|uploaded[featured_image]|max_size[featured_image,1024]|ext_in[featured_image,jpg,jpeg,png,gif]',
            'is_published' => 'permit_empty|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $article = $this->articleModel->find($id);
        if (!$article || $article['author_id'] !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan atau Anda tidak memiliki izin.');
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
            'is_published' => $this->request->getPost('is_published') ?? 0,
        ];

        if ($this->articleModel->update($id, $data)) {
            return redirect()->to(base_url('therapist/articles'))->with('success', 'Artikel berhasil diperbarui!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui artikel.');
        }
    }

    public function therapistArticlesDelete($id)
    {
        $article = $this->articleModel->find($id);

        if (!$article || $article['author_id'] !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan atau Anda tidak memiliki izin.');
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
