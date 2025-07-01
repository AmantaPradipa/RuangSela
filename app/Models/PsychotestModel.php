<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PsychotestModel
 * * Model untuk tabel 'psychotests'.
 * Mengelola data master untuk tes psikologi.
 */
class PsychotestModel extends Model
{
    /**
     * Nama tabel di database.
     * @var string
     */
    protected $table            = 'psychotests';
    
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
        'title', 
        'description', 
        'is_active'
    ];

    // Konfigurasi untuk Timestamps
    /**
     * Mengaktifkan penggunaan timestamp otomatis.
     * @var bool
     */
    protected $useTimestamps = false;
    
    /**
     * Nama kolom untuk 'created_at'.
     * @var string
     */
    protected $createdField  = '';
    
    /**
     * Nama kolom untuk 'updated_at'.
     * @var string
     */
    protected $updatedField  = '';

    /**
     * Mengambil semua tes psikologi yang aktif.
     *
     * @return array Daftar tes aktif.
     */
    public function getActiveTests(): array
    {
        return $this->where('is_active', 1)->findAll();
    }
}
