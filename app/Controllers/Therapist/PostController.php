<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Komunitas Terapis',
        ];
        return view('therapist/posts/post_feed', $data);
    }
}
