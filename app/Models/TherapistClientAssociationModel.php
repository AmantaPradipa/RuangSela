<?php

namespace App\Models;

use CodeIgniter\Model;

class TherapistClientAssociationModel extends Model
{
    protected $table            = 'therapist_client_associations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['therapist_id', 'client_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'associated_at';
    protected $updatedField  = ''; // No updated field for this table

    protected $validationRules = [
        'therapist_id' => 'required|numeric',
        'client_id'    => 'required|numeric|is_unique[therapist_client_associations.client_id,therapist_id,{therapist_id}]',
    ];
    protected $validationMessages = [
        'client_id' => [
            'is_unique' => 'Klien ini sudah terdaftar di bawah terapis ini.',
        ],
    ];
}