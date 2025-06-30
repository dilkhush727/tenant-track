<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailVerificationFieldsToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'email_verified' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'status'
            ],
            'verification_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'email_verified'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['email_verified', 'verification_token']);
    }
}
