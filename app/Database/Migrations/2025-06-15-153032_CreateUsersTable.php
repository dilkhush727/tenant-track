<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=> ['type'=>'INT','auto_increment'=>true],
            'name'=> ['type'=>'VARCHAR','constraint'=>100],
            'email'=> ['type'=>'VARCHAR','constraint'=>150,'unique'=>true],
            'password'=> ['type'=>'VARCHAR','constraint'=>255],
            'role'=> ['type'=>"ENUM('tenant','landlord','admin')"],
            'status'=> ['type'=>"ENUM('pending','active','disabled')",'default'=>'pending'],
            'created_at'=> ['type'=>'DATETIME','null'=>true],
            'updated_at'=> ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
