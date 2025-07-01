<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $role = session()->get('role');
        switch ($role) {
            case 'client':
                return redirect()->to(base_url('client/dashboard'));
            case 'therapist':
                return redirect()->to(base_url('therapist/dashboard'));
            case 'admin':
                return redirect()->to(base_url('admin/dashboard'));
            default:
                // Handle unexpected role or redirect to a default page
                return redirect()->to(base_url('login'));
        }
    }
}
