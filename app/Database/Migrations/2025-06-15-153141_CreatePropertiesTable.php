<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=> ['type'=>'INT','auto_increment'=>true],
            'landlord_id'=> ['type'=>'INT'],
            'address'=> ['type'=>'TEXT'],
            'type'=> ['type'=>'VARCHAR','constraint'=>50],
            'availability'=> ['type'=>'BOOLEAN','default'=>true],
            'description'=> ['type'=>'TEXT','null'=>true],
            'image'=> ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'created_at'=> ['type'=>'DATETIME','null'=>true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('landlord_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('properties');
    }

    public function down()
    {
        //
    }
}
