<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\ReviewModel;
use App\Models\TherapistModel;

class DashboardController extends BaseController
{
    protected $appointmentModel;
    protected $reviewModel;
    protected $therapistModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->reviewModel = new ReviewModel();
        $this->therapistModel = new TherapistModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $therapist = $this->therapistModel->where('user_id', $userId)->first();

        $data = [
            'title' => 'Dashboard Terapis',
            'user'  => session()->get(),
            'upcomingAppointments' => [],
            'recentReviews' => [],
            'therapist' => $therapist, // Pass therapist data to the view
        ];

        if ($therapist) {
            // Fetch upcoming appointments for the therapist
            $data['upcomingAppointments'] = $this->appointmentModel
                ->select('appointments.*, users.first_name as client_first_name, users.last_name as client_last_name, appointments.meeting_link')
                ->join('users', 'users.id = appointments.client_id')
                ->where('appointments.therapist_id', $therapist->id)
                ->where('appointments.scheduled_at >=', date('Y-m-d H:i:s'))
                ->orderBy('appointments.scheduled_at', 'ASC')
                ->findAll(5); // Limit to 5 upcoming appointments

            // Fetch recent reviews for the therapist
            $data['recentReviews'] = $this->reviewModel->getReviewsForTherapist($therapist->id, true);
        }

        return view('therapist/dashboard', $data);
    }
}