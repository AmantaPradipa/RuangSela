<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class ArticleController extends BaseController
{
    protected $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    public function clientArticleIndex()
    {
        $data = [
            'articles' => $this->articleModel->paginate(6, 'articles'),
            'pager'    => $this->articleModel->pager,
        ];
        return view('client/articles', $data);
    }
}
