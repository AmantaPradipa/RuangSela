<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ProgressNoteModel
 * * Model untuk tabel 'progress_notes'.
 * Mengelola catatan kemajuan klien yang dibuat oleh terapis.
 */
class ProgressNoteModel extends Model
{
    /**
     * Nama tabel di database.
     * @var string
     */
    protected $table            = 'progress_notes';
    
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
        'appointment_id', 
        'author_id', 
        'note'
    ];

    // Konfigurasi untuk Timestamps
    /**
     * Mengaktifkan penggunaan timestamp otomatis.
     * @var bool
     */
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil semua catatan untuk janji temu tertentu.
     *
     * @param int $appointmentId ID janji temu.
     * @return array Hasil query.
     */
    public function getNotesByAppointment(int $appointmentId): array
    {
        return $this->where('appointment_id', $appointmentId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}
