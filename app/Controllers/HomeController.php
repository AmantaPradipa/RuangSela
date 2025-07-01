<?php

namespace App\Controllers;

use App\Models\PlatformReviewModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $platformReviewModel = new PlatformReviewModel();
        $testimonials = $platformReviewModel->findAll(); // Mengambil semua ulasan platform

        // Memproses data untuk tampilan
        $processedTestimonials = [];
        foreach ($testimonials as $testimonial) {
            $processedTestimonials[] = [
                'user_name'    => 'Pengguna Anonim', // Ganti dengan nama pengguna jika tersedia
                'user_initials'=> 'PA', // Ganti dengan inisial pengguna jika tersedia
                'rating'       => $testimonial['rating'] ?? 0,
                'comment'      => $testimonial['comment'],
            ];
        }

        $data['testimonials'] = $processedTestimonials;

        return view('visitor/home', $data);
    }
}
