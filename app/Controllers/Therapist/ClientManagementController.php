<?php

namespace App\Controllers\Therapist;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AppointmentModel;
use App\Models\ProgressNoteModel;

class ClientManagementController extends BaseController
{
    protected $userModel;
    protected $appointmentModel;
    protected $progressNoteModel;
    protected $therapistClientAssociationModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->appointmentModel = new AppointmentModel();
        $this->progressNoteModel = new ProgressNoteModel();
        $this->therapistClientAssociationModel = new \App\Models\TherapistClientAssociationModel();
    }

    public function index()
    {
        $therapistId = session()->get('therapist_id'); // Assuming therapist_id is in session

        // Fetch clients associated with this therapist through appointments
        $clientsFromAppointments = $this->appointmentModel
                                        ->select('users.id, users.first_name, users.last_name, users.email, users.profile_picture')
                                        ->join('users', 'users.id = appointments.client_id')
                                        ->where('appointments.therapist_id', $therapistId)
                                        ->distinct()
                                        ->findAll();

        // Fetch clients directly associated with this therapist
        $clientsFromAssociations = $this->therapistClientAssociationModel
                                        ->select('users.id, users.first_name, users.last_name, users.email, users.profile_picture')
                                        ->join('users', 'users.id = therapist_client_associations.client_id')
                                        ->where('therapist_client_associations.therapist_id', $therapistId)
                                        ->distinct()
                                        ->findAll();

        // Merge and remove duplicates
        $allClients = array_merge($clientsFromAppointments, $clientsFromAssociations);
        $uniqueClients = [];
        $seenIds = [];
        foreach ($allClients as $client) {
            if (!in_array($client->id, $seenIds)) {
                $uniqueClients[] = $client;
                $seenIds[] = $client->id;
            }
        }

        $data = [
            'title' => 'Manajemen Klien',
            'clients' => $uniqueClients,
        ];
        return view('therapist/clients/clients_list', $data);
    }

    public function viewClient($clientId)
    {
        $therapistId = session()->get('therapist_id');

        // Verify that this client is associated with the therapist either through appointments or direct association
        $isAssociated = $this->appointmentModel
                             ->where('client_id', $clientId)
                             ->where('therapist_id', $therapistId)
                             ->first();

        if (!$isAssociated) {
            $isAssociated = $this->therapistClientAssociationModel
                                 ->where('client_id', $clientId)
                                 ->where('therapist_id', $therapistId)
                                 ->first();
        }

        if (!$isAssociated) {
            return redirect()->back()->with('error', 'Klien tidak ditemukan atau tidak terkait dengan Anda.');
        }

        $client = $this->userModel->find($clientId);
        $appointments = $this->appointmentModel->where('client_id', $clientId)->where('therapist_id', $therapistId)->orderBy('scheduled_at', 'DESC')->findAll();
        $progressNotes = $this->progressNoteModel->where('author_id', session()->get('user_id'))->where('client_id', $clientId)->orderBy('created_at', 'DESC')->findAll(); // Assuming progress notes are linked to client and therapist

        $data = [
            'title' => 'Detail Klien: ' . $client['first_name'],
            'client' => $client,
            'appointments' => $appointments,
            'progressNotes' => $progressNotes,
        ];
        return view('therapist/clients/client_detail', $data);
    }

    public function saveProgressNote()
    {
        $rules = [
            'appointment_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'note' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $therapistUserId = session()->get('user_id');
        $appointmentId = $this->request->getPost('appointment_id');
        $clientId = $this->request->getPost('client_id');
        $note = $this->request->getPost('note');

        // Verify association before saving
        $appointment = $this->appointmentModel->find($appointmentId);
        if (!$appointment || $appointment->client_id != $clientId || $appointment->therapist_id != session()->get('therapist_id')) { // Assuming therapist_id is stored in session
            return redirect()->back()->with('error', 'Janji temu tidak valid atau tidak terkait.');
        }

        $data = [
            'appointment_id' => $appointmentId,
            'author_id' => $therapistUserId,
            'note' => $note,
        ];

        if ($this->progressNoteModel->save($data)) {
            return redirect()->back()->with('success', 'Catatan kemajuan berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan catatan kemajuan.');
        }
    }

    public function editProgressNote($noteId)
    {
        $note = $this->progressNoteModel->find($noteId);

        if (!$note || $note->author_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Catatan tidak ditemukan atau Anda tidak memiliki izin.');
        }

        $client = $this->userModel->find($note->client_id); // Assuming client_id is stored in progress_notes or can be derived from appointment_id

        $data = [
            'title' => 'Edit Catatan Kemajuan',
            'note' => $note,
            'client' => $client,
        ];
        return view('therapist/clients/edit_progress_note', $data);
    }

    public function updateProgressNote($noteId)
    {
        $rules = [
            'note' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $note = $this->progressNoteModel->find($noteId);

        if (!$note || $note->author_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Catatan tidak ditemukan atau Anda tidak memiliki izin.');
        }

        $data = [
            'note' => $this->request->getPost('note'),
        ];

        if ($this->progressNoteModel->update($noteId, $data)) {
            return redirect()->to(base_url('therapist/klien/view/' . $note->client_id))->with('success', 'Catatan kemajuan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui catatan kemajuan.');
        }
    }

    public function deleteProgressNote($noteId)
    {
        $note = $this->progressNoteModel->find($noteId);

        if (!$note || $note->author_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Catatan tidak ditemukan atau Anda tidak memiliki izin.');
        }

        $clientId = $note->client_id;

        if ($this->progressNoteModel->delete($noteId)) {
            return redirect()->to(base_url('therapist/klien/view/' . $clientId))->with('success', 'Catatan kemajuan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus catatan kemajuan.');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Klien Baru',
        ];
        return view('therapist/clients/create_client', $data);
    }

    public function save()
    {
        $rules = [
            'first_name' => 'required|max_length[50]',
            'last_name' => 'permit_empty|max_length[50]',
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[50]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role' => 'client',
            'is_active' => 1, // New clients are active by default
        ];

        if (!$this->userModel->save($userData)) {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat akun klien baru.');
        }

        $newClientId = $this->userModel->getInsertID();
        $therapistUserId = session()->get('user_id');
        $therapist = $this->therapistModel->where('user_id', $therapistUserId)->first();

        if (!$therapist) {
            // This should ideally not happen if the therapist is logged in
            return redirect()->back()->with('error', 'Profil terapis tidak ditemukan.');
        }

        $associationData = [
            'therapist_id' => $therapist->id,
            'client_id' => $newClientId,
        ];

        if (!$this->therapistClientAssociationModel->save($associationData)) {
            // If association fails, consider deleting the newly created user or logging an error
            $this->userModel->delete($newClientId); // Rollback user creation
            return redirect()->back()->withInput()->with('error', 'Gagal mengaitkan klien dengan terapis.');
        }

        return redirect()->to(base_url('therapist/klien'))->with('success', 'Klien baru berhasil ditambahkan dan dikaitkan.');
    }
}