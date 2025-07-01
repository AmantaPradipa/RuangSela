<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;
use App\Models\ReviewModel;
use App\Models\TherapistModel;

class ReviewController extends BaseController
{
    protected $reviewModel;
    protected $therapistModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
        $this->therapistModel = new TherapistModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $therapist = $this->therapistModel->where('user_id', $userId)->first();

        if (!$therapist) {
            return redirect()->back()->with('error', 'Profil terapis tidak ditemukan.');
        }

        $reviews = $this->reviewModel->getReviewsForTherapist($therapist->id, false); // Get all reviews, published or not

        // Add user_name and user_profile_picture to reviews
        foreach ($reviews as &$review) {
            $user = $this->userModel->find($review->client_id);
            $review->user_name = $user['first_name'] . ' ' . $user['last_name'];
            $review->user_profile_picture = $user['profile_picture'];
        }

        $data = [
            'title' => 'Ulasan Klien',
            'reviews' => $reviews,
        ];
        return view('therapist/reviews/reviews_list', $data);
    }
}