<?php

namespace App\Models;

use CodeIgniter\Model;

class TherapistModel extends Model
{
    protected $table            = 'therapists';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'user_id',
        'expertise',
        'experience_years',
        'education',
        'license_number',
        'license_file',
        'id_card_file',
        'verification_status',
        'verification_notes',
        'bio',
        'is_available'
    ];

    // Timestamps
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';

    protected array $casts = [
        'education' => 'json',
    ];

    /**
     * Mengambil daftar terapis dengan data user terkait untuk halaman visitor.
     *
     * @param int $perPage
     * @return array
     */
    public function getActiveTherapistsWithDetails(int $perPage = 9): array
    {
        return $this->select('
                therapists.id,
                therapists.expertise,
                therapists.experience_years,
                users.first_name,
                users.last_name,
                users.profile_picture
            ')
            ->join('users', 'users.id = therapists.user_id')
            ->where('users.role', 'therapist')
            ->where('users.is_active', 1)
            ->paginate($perPage, 'therapists');
    }

    /**
     * Mengambil detail lengkap seorang terapis berdasarkan ID.
     *
     * @param int $id
     * @return object|null
     */
    public function findTherapistDetailById(int $id): ?object
    {
        return $this->select('
                therapists.*,
                users.first_name,
                users.last_name,
                users.profile_picture,
                users.city,
                users.country
            ')
            ->join('users', 'users.id = therapists.user_id')
            ->where('therapists.id', $id)
            ->where('users.role', 'therapist')
            ->where('users.is_active', 1)
            ->first();
    }
}