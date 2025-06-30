<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'landlord_id', 'address', 'type', 'availability',
        'description', 'image', 'created_at'
    ];
}