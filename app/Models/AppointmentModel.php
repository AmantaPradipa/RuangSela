<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AppointmentModel
 * * Model untuk tabel 'appointments'.
 * Mengelola data janji temu antara klien dan terapis.
 */
class AppointmentModel extends Model
{
    /**
     * Nama tabel di database.
     * @var string
     */
    protected $table            = 'appointments';
    
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
        'client_id', 
        'therapist_id', 
        'package_id', 
        'scheduled_at', 
        'duration_minutes', 
        'status', 
        'meeting_link'
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
     * Mengambil detail janji temu, termasuk data klien, terapis, dan paket.
     *
     * @param int $appointmentId ID janji temu.
     * @return object|null Hasil query.
     */
    public function getAppointmentDetails(int $appointmentId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            appointments.*, 
            client.first_name as client_first_name, 
            client.last_name as client_last_name, 
            therapist_user.first_name as therapist_first_name, 
            therapist_user.last_name as therapist_last_name, 
            packages.name as package_name
        ');
        $builder->join('users as client', 'client.id = appointments.client_id');
        $builder->join('therapists', 'therapists.id = appointments.therapist_id');
        $builder->join('users as therapist_user', 'therapist_user.id = therapists.user_id');
        $builder->join('packages', 'packages.id = appointments.package_id');
        $builder->where('appointments.id', $appointmentId);
        
        return $builder->get()->getRow();
    }
}
