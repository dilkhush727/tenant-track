<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLeasesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>['type'=>'INT','auto_increment'=>true],
            'tenant_id'=>['type'=>'INT'],
            'property_id'=>['type'=>'INT'],
            'start_date'=>['type'=>'DATE'],
            'end_date'=>['type'=>'DATE'],
            'monthly_rent'=>['type'=>'DECIMAL','constraint'=>'10,2'],
            'agreement_file'=>['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'created_at'=>['type'=>'DATETIME','null'=>true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tenant_id','users','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('property_id','properties','id','CASCADE','CASCADE');
        $this->forge->createTable('leases');
    }

    public function down()
    {
        //
    }
}
