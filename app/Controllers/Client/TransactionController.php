<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class TransactionController extends BaseController
{
    protected $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $data = [
            'title' => 'Riwayat Transaksi',
            'transactions' => $this->transactionModel->where('user_id', $userId)->orderBy('transaction_date', 'DESC')->findAll(),
        ];
        return view('client/transactions/transactions_list', $data);
    }

    public function view($id)
    {
        $userId = session()->get('user_id');
        $transaction = $this->transactionModel->where('user_id', $userId)->find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Transaksi',
            'transaction' => $transaction,
        ];
        return view('client/transactions/transaction_detail', $data);
    }
}
