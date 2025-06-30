<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table      = 'messages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'sender_id', 'receiver_id', 'subject', 'body', 'message_type', 'is_read', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
}
