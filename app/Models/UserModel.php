<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = ['username', 'email', 'password', 'first_name', 'last_name', 'role', 'is_verified', 'is_active', 'profile_picture', 'id_card_file', 'phone', 'address', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Callbacks
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    // Validation rules
    protected $validationRules = [
        // Aturan is_unique akan lebih baik ditangani di controller untuk konteks update
        'username'      => 'required|alpha_numeric_space|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password'      => 'permit_empty|min_length[8]', // Dibuat permit_empty karena tidak diupdate di form profil
        'first_name'    => 'required|string|max_length[50]',
        'last_name'     => 'permit_empty|string|max_length[50]',
        'role'          => 'permit_empty|in_list[client,therapist,admin]',
        'is_verified'   => 'permit_empty|in_list[0,1]',
        'is_active'     => 'permit_empty|in_list[0,1]',
        'profile_picture'=> 'permit_empty|string|max_length[255]',
        'phone'         => 'permit_empty|alpha_numeric_punct|max_length[15]',
        'address'       => 'permit_empty|string|max_length[255]',
    ];
    
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Maaf. Username tersebut sudah terdaftar.',
            'required' => 'Username wajib diisi.',
        ],
        'email' => [
            'is_unique' => 'Maaf. Email tersebut sudah terdaftar.',
            'required' => 'Email wajib diisi.',
        ],
        'password' => [
            'min_length' => 'Kata sandi minimal 8 karakter.',
        ],
        'first_name' => [
            'required' => 'Nama depan wajib diisi.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    
    protected function hashPassword(array $data)
    {
        // Hanya hash password jika ada isinya
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            // Hapus field password dari data update jika kosong
            unset($data['data']['password']);
        }

        return $data;
    }

    /**
     * Mengambil semua pengguna dengan peran 'therapist'.
     *
     * @return array
     */
    public function getTherapistUsers(): array
    {
        return $this->where('role', 'therapist')->findAll();
    }
}
