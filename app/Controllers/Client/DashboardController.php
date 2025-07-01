<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\ActivityLogModel;
use App\Models\TransactionModel;
use App\Models\PackageModel;

class DashboardController extends BaseController
{
    protected $appointmentModel;
    protected $activityLogModel;
    protected $transactionModel;
    protected $packageModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->activityLogModel = new ActivityLogModel();
        $this->transactionModel = new TransactionModel();
        $this->packageModel = new PackageModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $data = [
            'title' => 'Dashboard Klien',
            'user'  => session()->get(),
            'upcomingAppointments' => $this->appointmentModel->where('client_id', $userId)->where('status', 'scheduled')->orderBy('scheduled_at', 'ASC')->findAll(2), // Get 2 upcoming appointments
            'recentActivities' => $this->activityLogModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll(5), // Get 5 recent activities
            'activePackage' => $this->transactionModel->where('user_id', $userId)->where('status', 'completed')->orderBy('transaction_date', 'DESC')->first(),
        ];

        if ($data['activePackage']) {
            $packageDetails = $this->packageModel->find($data['activePackage']['package_id']);
            $data['activePackage']['name'] = $packageDetails['name'] ?? 'N/A';
            $data['activePackage']['total_sessions'] = $packageDetails['sessions_count'] ?? 0;
            $data['activePackage']['sessions_remaining'] = ($packageDetails['sessions_count'] ?? 0) - ($data['activePackage']['sessions_used'] ?? 0);
        }

        return view('client/dashboard', $data);
    }
}