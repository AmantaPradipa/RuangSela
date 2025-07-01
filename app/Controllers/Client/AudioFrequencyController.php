<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;

class AudioFrequencyController extends BaseController
{
    public function index()
    {
        return view('client/audio_frequency');
    }
}
