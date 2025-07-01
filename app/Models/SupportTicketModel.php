<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportTicketModel extends Model
{
    protected $table            = 'support_tickets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'category', 'subject', 'description', 'status', 'priority'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [
        'user_id'     => 'required|is_natural_no_zero',
        'category'    => 'required|in_list[bug,feedback,payment,other]',
        'subject'     => 'required|string|max_length[255]',
        'description' => 'required|string',
        'status'      => 'required|in_list[open,in_progress,resolved,closed]',
        'priority'    => 'required|in_list[low,medium,high]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}

