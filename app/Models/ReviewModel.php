<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ReviewModel
 * * Model untuk tabel 'reviews'.
 * Mengelola ulasan dan peringkat yang diberikan oleh klien kepada terapis.
 */
class ReviewModel extends Model
{
    /**
     * Nama tabel di database.
     * @var string
     */
    protected $table            = 'reviews';
    
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
        'client_id', 
        'therapist_id', 
        'rating', 
        'comment', 
        'is_published'
    ];

    // Konfigurasi untuk Timestamps
    /**
     * Mengaktifkan penggunaan timestamp otomatis.
     * @var bool
     */
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    
    /**
     * Tabel ini tidak memiliki kolom 'updated_at'.
     * @var string|null
     */
    protected $updatedField  = null;

    /**
     * Mengambil ulasan untuk terapis tertentu, termasuk detail klien.
     *
     * @param int $therapistId ID terapis.
     * @param bool $publishedOnly Apakah hanya menampilkan ulasan yang sudah dipublikasikan.
     * @return array Hasil query.
     */
    public function getReviewsForTherapist(int $therapistId, bool $publishedOnly = true): array
    {
        $builder = $this->db->table($this->table);
        $builder->select('reviews.*, users.first_name, users.last_name, users.profile_picture');
        $builder->join('users', 'users.id = reviews.client_id');
        $builder->where('reviews.therapist_id', $therapistId);
        
        if ($publishedOnly) {
            $builder->where('reviews.is_published', 1);
        }

        return $builder->orderBy('reviews.created_at', 'DESC')->get()->getResult();
    }
}
