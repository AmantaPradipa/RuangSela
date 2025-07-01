<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * TestQuestionModel
 * * Model untuk tabel 'test_questions'.
 * Mengelola pertanyaan-pertanyaan untuk setiap tes psikologi.
 */
class TestQuestionModel extends Model
{
    /**
     * Nama tabel di database.
     * @var string
     */
    protected $table            = 'test_questions';
    
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
        'psychotest_id', 
        'question', 
        'question_order'
    ];

    /**
     * Tabel ini tidak menggunakan timestamp.
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Mengambil semua pertanyaan untuk sebuah tes, terurut.
     *
     * @param int $psychotestId ID tes psikologi.
     * @return array Daftar pertanyaan.
     */
    public function getQuestionsForTest(int $psychotestId): array
    {
        return $this->where('psychotest_id', $psychotestId)
                    ->orderBy('question_order', 'ASC')
                    ->findAll();
    }
}