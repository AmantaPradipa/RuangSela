<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table            = 'articles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Perubahan dilakukan di sini
    protected $allowedFields    = [
        'author_id',
        'title',
        'content',
        'excerpt',
        'featured_image',
        'is_published'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Menemukan artikel beserta detail penulisnya.
     *
     * @param int $id ID Artikel
     * @return array|null
     */
    public function findArticleWithAuthor(int $id): ?array
    {
        return $this->select('articles.*, users.first_name, users.last_name')
                    ->join('users', 'users.id = articles.author_id', 'left')
                    ->where('articles.id', $id)
                    ->first();
    }
}
