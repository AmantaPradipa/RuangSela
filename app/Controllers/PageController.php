<?php

namespace App\Controllers;

use App\Models\PlatformReviewModel;
use App\Models\ArticleModel;
use App\Models\PsychotestModel;
use App\Models\TherapistModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PageController extends BaseController
{
    public function layanan(): string
    {
        return view('visitor/services');
    }

    public function konsultasi(): string
    {
        $platformReviewModel = new PlatformReviewModel();
        $packageModel = new \App\Models\PackageModel();

        $testimonials = $platformReviewModel->getReviewsWithUserDetails(3); // Mengambil 3 ulasan terbaru dengan detail pengguna
        $packages = $packageModel->getActivePackages(); // Mengambil semua paket aktif

        // Memproses data untuk tampilan testimoni
        $processedTestimonials = [];
        foreach ($testimonials as $testimonial) {
            $userName = trim(($testimonial['first_name'] ?? '') . ' ' . ($testimonial['last_name'] ?? ''));
            if (empty($userName)) {
                $userName = 'Pengguna Anonim';
            }
            $userInitials = strtoupper(substr($testimonial['first_name'] ?? 'P', 0, 1) . substr($testimonial['last_name'] ?? 'A', 0, 1));

            $processedTestimonials[] = [
                'user_name'    => $userName,
                'user_initials'=> $userInitials,
                'rating'       => $testimonial['rating'] ?? 0,
                'comment'      => $testimonial['comment'],
                'profile_picture' => $testimonial['profile_picture'] ?? null,
            ];
        }

        $data['testimonials'] = $processedTestimonials;
        $data['packages'] = $packages;

        return view('visitor/packages', $data);
    }

    public function artikel(): string
    {
        $articleModel = new \App\Models\ArticleModel();
        $data = [
            'articles' => $articleModel->paginate(6, 'articles'),
            'pager'    => $articleModel->pager,
        ];
        return view('visitor/articles', $data);
    }

    /**
     * Menampilkan halaman detail artikel.
     *
     * @param int $id
     * @return string
     */
    public function artikelDetail(int $id): string
    {
        $articleModel = new ArticleModel();
        $article = $articleModel->findArticleWithAuthor($id);

        if (!$article || !$article['is_published']) {
            throw PageNotFoundException::forPageNotFound('Artikel tidak ditemukan atau belum dipublikasikan.');
        }

        // Gabungkan nama depan dan belakang penulis
        $article['author_name'] = trim(($article['first_name'] ?? '') . ' ' . ($article['last_name'] ?? ''));
        if (empty($article['author_name'])) {
            $article['author_name'] = 'Penulis Anonim';
        }

        $data['article'] = $article;
        return view('visitor/article_detail', $data);
    }

    public function psikotes(): string
    {
        $psychotestModel = new PsychotestModel();
        $data['tests'] = $psychotestModel->where('is_active', 1)->findAll();

        return view('visitor/psychotest', $data);
    }

    public function terapis(): string
    {
        $therapistModel = new TherapistModel();
        $data = [
            'therapists' => $therapistModel->getActiveTherapistsWithDetails(9),
            'pager'      => $therapistModel->pager,
        ];

        return view('visitor/therapists', $data);
    }

    public function terapisDetail(int $id): string
    {
        $therapistModel = new TherapistModel();
        $therapist = $therapistModel->findTherapistDetailById($id);

        if (!$therapist) {
            throw PageNotFoundException::forPageNotFound('Terapis tidak ditemukan.');
        }

        // Decode JSON fields
        $therapist->education = json_decode($therapist->education, true);

        // Load ReviewModel and fetch reviews for the therapist
        $reviewModel = new \App\Models\ReviewModel();
        $therapist->reviews = $reviewModel->getReviewsForTherapist($therapist->id);

        $data['therapist'] = $therapist;

        return view('visitor/therapist_detail', $data);
    }

    public function faq(): string
    {
        $faqModel = new \App\Models\FAQModel();
        $faqs = $faqModel->where('is_active', 1)->findAll();

        $groupedFaqs = [];
        foreach ($faqs as $faq) {
            $groupedFaqs[$faq['category']][] = $faq;
        }

        $data['faqs'] = $groupedFaqs;

        return view('visitor/faq', $data);
    }

    public function audioFrequency(): string
    {
        $audioToneModel = new \App\Models\AudioToneModel();
        $rawAudioTones = $audioToneModel->where('is_public', 1)->findAll();

        $processedTones = [];
        foreach ($rawAudioTones as $tone) {
            $processedTones[] = [
                'icon'        => 'ri-headphone-line', // Default icon, can be dynamic if added to DB
                'title'       => $tone['title'],
                'subtitle'    => $tone['frequency_hz'] . ' Hz',
                'file'        => base_url($tone['file_path']), // Construct full URL for public assets
                'description' => $tone['description'],
            ];
        }

        $data['tones'] = $processedTones;

        return view('visitor/frequency', $data);
    }
}