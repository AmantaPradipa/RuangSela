<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\PackageModel;
use App\Models\TransactionModel;
use App\Models\PlatformReviewModel;

class PackageController extends BaseController
{
    protected $packageModel;
    protected $transactionModel;
    protected $platformReviewModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
        $this->transactionModel = new TransactionModel();
        $this->platformReviewModel = new PlatformReviewModel();
    }

    public function index()
    {
        $testimonials = $this->platformReviewModel->getReviewsWithUserDetails(3); // Mengambil 3 ulasan terbaru dengan detail pengguna

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

        $data = [
            'title' => 'Daftar Paket Konsultasi',
            'packages' => $this->packageModel->where('is_active', 1)->findAll(),
            'testimonials' => $processedTestimonials,
        ];
        return view('client/packages/packages_list', $data);
    }

    public function purchase($packageId)
    {
        $package = $this->packageModel->find($packageId);

        if (!$package) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        $data = [
            'title' => 'Beli Paket Konsultasi',
            'package' => $package,
        ];
        return view('client/packages/purchase_package', $data);
    }

    public function processPurchase()
    {
        $rules = [
            'package_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $packageId = $this->request->getPost('package_id');
        $amount = $this->request->getPost('amount');
        $paymentMethod = $this->request->getPost('payment_method');
        

        $transactionData = [
            'user_id' => session()->get('user_id'),
            'package_id' => $packageId,
            'amount' => $amount,
            'status' => 'pending', // Set status to pending for admin verification
            'payment_method' => $paymentMethod,
            
            'sessions_used' => 0,
        ];

        if ($this->transactionModel->save($transactionData)) {
            return redirect()->to(site_url('client/paket/purchase-success'))->with('success', 'Pembelian paket berhasil! Menunggu verifikasi pembayaran.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memproses pembelian paket.');
        }
    }

    public function purchaseSuccess()
    {
        $data = [
            'title' => 'Pembelian Berhasil',
        ];
        return view('client/packages/purchase_success', $data);
    }
}
