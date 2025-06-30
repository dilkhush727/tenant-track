<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'email', 'password', 'role', 'status', 'email_verified', 'verification_token'];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Hash the password before insert/update
    protected function hashPassword(array $data)
    {
        // Check if password exists and hash it
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            // Ensure the password is not altered during update if it's empty
            unset($data['data']['password']);
        }
        return $data;
    }
}
