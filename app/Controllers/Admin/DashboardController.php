<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TherapistModel;
use App\Models\ArticleModel;
use App\Models\SupportTicketModel;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $therapistModel;
    protected $articleModel;
    protected $supportTicketModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->therapistModel = new TherapistModel();
        $this->articleModel = new ArticleModel();
        $this->supportTicketModel = new SupportTicketModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'user'  => session()->get(),
            'totalUsers' => $this->userModel->countAllResults(),
            'totalTherapists' => $this->therapistModel->countAllResults(),
            'pendingTherapistVerifications' => $this->therapistModel->where('verification_status', 'pending')->countAllResults(),
            'totalArticles' => $this->articleModel->countAllResults(),
            'totalSupportTickets' => $this->supportTicketModel->countAllResults(),
            'pendingSupportTickets' => $this->supportTicketModel->where('status', 'open')->countAllResults(),
            'recentTherapistVerifications' => $this->therapistModel->orderBy('created_at', 'DESC')->findAll(5),
            'recentContent' => $this->articleModel->orderBy('created_at', 'DESC')->findAll(5),
            'recentSupportTickets' => $this->supportTicketModel->orderBy('created_at', 'DESC')->findAll(5),
        ];
        return view('admin/dashboard', $data);
    }
}