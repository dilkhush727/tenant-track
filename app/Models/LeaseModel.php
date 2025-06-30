<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaseModel extends Model
{
    protected $table = 'leases';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tenant_id',
        'property_id',
        'start_date',
        'end_date',
        'monthly_rent',
        'agreement_file',
        'created_at'
    ];
    public $timestamps = false;
}
