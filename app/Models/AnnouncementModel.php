<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'message', 'target_role', 'created_at'];

    public function getForRole($role)
    {
        return $this->where('target_role', $role)
                    ->orWhere('target_role', 'all')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}
