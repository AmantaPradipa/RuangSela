<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * TherapistScheduleModel
 * * Model untuk tabel 'therapist_schedules'.
 * Mengelola jadwal ketersediaan para terapis.
 */
class TherapistScheduleModel extends Model
{
    /**
     * Nama tabel di database.
     * @var string
     */
    protected $table            = 'therapist_schedules';
    
    /**
     * Primary key dari tabel.
     * @var string
     */
    protected $primaryKey       = 'id';
    
    /**
     * Menggunakan auto-increment.
     * @var bool
     */
    protected $useAutoIncrement = true;
    
    /**
     * Tipe data yang dikembalikan.
     * @var string
     */
    protected $returnType       = 'object';

    /**
     * Kolom yang diizinkan untuk diisi.
     * @var array
     */
    protected $allowedFields    = [
        'therapist_id', 
        'day_of_week', 
        'start_time', 
        'end_time', 
        'is_available'
    ];

    /**
     * Tabel ini tidak memiliki kolom timestamp (created_at, updated_at).
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Mengambil semua jadwal untuk seorang terapis tertentu.
     *
     * @param int $therapistId ID terapis.
     * @return array Hasil query.
     */
    public function getSchedulesByTherapist(int $therapistId): array
    {
        return $this->where('therapist_id', $therapistId)->findAll();
    }
}
