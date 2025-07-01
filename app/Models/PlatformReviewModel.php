<?php

namespace App\Models;

use CodeIgniter\Model;

class PlatformReviewModel extends Model
{
    protected $table            = 'platform_reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'category',
        'rating',
        'comment',
        'page_url',
        'status',
    ];

    // Dates
    // Hanya created_at yang akan dikelola secara otomatis oleh model.
    // updated_at tidak ada di tabel ini.
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';

    // Validation
    protected $validationRules      = [
        'user_id'  => 'required|is_natural_no_zero',
        'category' => 'required|in_list[general,ui_ux,bug_report,feature_request]',
        'rating'   => 'permit_empty|is_natural|less_than_equal_to[5]',
        'comment'  => 'required|string|min_length[10]',
        'page_url' => 'permit_empty|valid_url_strict',
        'status'   => 'permit_empty|in_list[new,acknowledged,in_progress,resolved]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];

    /**
     * Mengambil ulasan platform terbaik (misalnya, rating tinggi).
     *
     * @param int $limit Jumlah ulasan yang ingin diambil.
     * @return array
     */
    public function getReviewsWithUserDetails(int $limit = 3): array
    {
        return $this->select('platform_reviews.*, users.first_name, users.last_name, users.profile_picture')
                    ->join('users', 'users.id = platform_reviews.user_id')
                    ->where('platform_reviews.status', 'approved') // Assuming a status for approved reviews
                    ->orderBy('platform_reviews.created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}