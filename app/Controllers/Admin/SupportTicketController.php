<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SupportTicketModel;
use App\Models\TicketResponseModel;
use App\Models\UserModel;

class SupportTicketController extends BaseController
{
    protected $supportTicketModel;
    protected $ticketResponseModel;
    protected $userModel;

    public function __construct()
    {
        $this->supportTicketModel = new SupportTicketModel();
        $this->ticketResponseModel = new TicketResponseModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Tiket Dukungan',
            'tickets' => $this->supportTicketModel->findAll(),
        ];
        return view('admin/tickets/tickets_list', $data);
    }

    public function view($id)
    {
        $ticket = $this->supportTicketModel->find($id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        $user = $this->userModel->find($ticket['user_id']);
        $responses = $this->ticketResponseModel->where('ticket_id', $id)->orderBy('created_at', 'ASC')->findAll();

        $data = [
            'title' => 'Detail Tiket Dukungan',
            'ticket' => $ticket,
            'user' => $user,
            'responses' => $responses,
        ];
        return view('admin/tickets/ticket_detail', $data);
    }

    public function updateStatus($id)
    {
        $rules = [
            'status' => 'required|in_list[open,in_progress,resolved,closed]',
            'priority' => 'required|in_list[low,medium,high]',
            'response_message' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $ticket = $this->supportTicketModel->find($id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        $ticketData = [
            'status' => $this->request->getPost('status'),
            'priority' => $this->request->getPost('priority'),
        ];

        $this->supportTicketModel->update($id, $ticketData);

        $responseMessage = $this->request->getPost('response_message');
        if (!empty($responseMessage)) {
            $responseData = [
                'ticket_id' => $id,
                'user_id' => session()->get('user_id'), // Admin user ID
                'message' => $responseMessage,
            ];
            $this->ticketResponseModel->save($responseData);
        }

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui.');
    }

    public function delete($id)
    {
        if ($this->supportTicketModel->delete($id)) {
            return redirect()->back()->with('success', 'Tiket berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus tiket.');
        }
    }
}
