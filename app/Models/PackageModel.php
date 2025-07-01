<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table            = 'packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'description',
        'price',
        'sessions_count',
        'features', // Kolom baru ditambahkan
        'is_active',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['encodeFeatures'];
    protected $beforeUpdate   = ['encodeFeatures'];
    protected $afterFind      = ['decodeFeatures'];

    /**
     * Mengambil semua paket yang aktif.
     *
     * @return array
     */
    public function getActivePackages(): array
    {
        return $this->where('is_active', 1)->findAll();
    }

    /**
     * Callback untuk meng-encode field 'features' dari array ke JSON sebelum disimpan.
     *
     * @param array $data
     * @return array
     */
    protected function encodeFeatures(array $data): array
    {
        if (isset($data['data']['features']) && is_array($data['data']['features'])) {
            $data['data']['features'] = json_encode($data['data']['features']);
        }

        return $data;
    }

    /**
     * Callback untuk men-decode field 'features' dari JSON ke array secara otomatis.
     *
     * @param array $data
     * @return array
     */
    protected function decodeFeatures(array $data): array
    {
        if (empty($data['data'])) {
            return $data;
        }

        // Handle find() which returns a single associative array
        if (isset($data['data']['id'])) {
            if (isset($data['data']['features']) && is_string($data['data']['features'])) {
                $data['data']['features'] = json_decode($data['data']['features'], true) ?? [];
            }
        } else { // Handle findAll() which returns an array of arrays
            foreach ($data['data'] as &$package) {
                if (isset($package['features']) && is_string($package['features'])) {
                    $package['features'] = json_decode($package['features'], true) ?? [];
                }
            }
        }
        return $data;
    }
}