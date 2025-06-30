<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'name'      => 'Super Admin',
            'email'     => 'admin@tenanttrack.com',
            'password'  => password_hash('Dilkhush@727', PASSWORD_DEFAULT),
            'role'      => 'admin',
            'status'    => 'active',
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
    }
}
