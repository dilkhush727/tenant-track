<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'lease_id', 'amount', 'date_paid', 'method', 'status', 'receipt'
    ];
}