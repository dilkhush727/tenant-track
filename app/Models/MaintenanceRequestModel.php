<?php

namespace App\Models;

use CodeIgniter\Model;

class MaintenanceRequestModel extends Model
{
    protected $table = 'maintenance_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tenant_id', 'property_id', 'issue_type', 'description',
        'status', 'submitted_at', 'resolved_at', 'feedback', 'image'
    ];
    public $timestamps = false;
}
