<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Komunitas',
        ];
        return view('client/posts/post_feed', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Buat Postingan Baru',
        ];
        return view('client/posts/create_post', $data);
    }
}
