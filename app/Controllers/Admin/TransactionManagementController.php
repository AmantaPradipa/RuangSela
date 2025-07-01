<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\UserModel;
use App\Models\PackageModel;

class TransactionManagementController extends BaseController
{
    protected $transactionModel;
    protected $userModel;
    protected $packageModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->userModel = new UserModel();
        $this->packageModel = new PackageModel();
    }

    public function index($status = null)
    {
        if ($status && in_array($status, ['pending', 'completed', 'failed'])) {
            $transactions = $this->transactionModel->where('status', $status)->findAll();
        } else {
            $transactions = $this->transactionModel->findAll();
        }

        foreach ($transactions as &$transaction) {
            $user = $this->userModel->find($transaction['user_id']);
            $package = $this->packageModel->find($transaction['package_id']);

            $transaction['user_name'] = $user ? ($user['first_name'] . ' ' . $user['last_name']) : 'N/A';
            $transaction['user_email'] = $user ? $user['email'] : 'N/A';
            $transaction['package_name'] = $package ? $package['name'] : 'N/A';
        }

        $data = [
            'title' => 'Manajemen Transaksi',
            'transactions' => $transactions,
        ];
        return view('admin/transactions/transactions_list', $data);
    }

    public function view($id)
    {
        $transaction = $this->transactionModel->find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $user = $this->userModel->find($transaction['user_id']);
        $package = $this->packageModel->find($transaction['package_id']);

        $transaction['user_name'] = $user ? ($user['first_name'] . ' ' . $user['last_name']) : 'N/A';
        $transaction['user_email'] = $user ? $user['email'] : 'N/A';
        $transaction['package_name'] = $package ? $package['name'] : 'N/A';

        $data = [
            'title' => 'Detail Transaksi',
            'transaction' => $transaction,
            'user' => $user,
            'package' => $package,
        ];
        return view('admin/transactions/transaction_detail', $data);
    }

    public function updateStatus($id)
    {
        $rules = [
            'status' => 'required|in_list[pending,completed,failed]',
            'admin_notes' => 'permit_empty|string',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $transaction = $this->transactionModel->find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $data = [
            'status' => $this->request->getPost('status'),
            'admin_notes' => $this->request->getPost('admin_notes'),
        ];

        if ($this->transactionModel->update($id, $data)) {
            return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui status transaksi.');
        }
    }

    public function delete($id)
    {
        if ($this->transactionModel->delete($id)) {
            return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus transaksi.');
        }
    }
}
