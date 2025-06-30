<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>['type'=>'INT','auto_increment'=>true],
            'lease_id'=>['type'=>'INT'],
            'amount'=>['type'=>'DECIMAL','constraint'=>'10,2'],
            'date_paid'=>['type'=>'DATE'],
            'method'=>['type'=>'VARCHAR','constraint'=>50],
            'status'=>['type'=>"ENUM('paid','failed','pending')",'default'=>'pending'],
            'receipt'=>['type'=>'VARCHAR','constraint'=>255,'null'=>true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('lease_id','leases','id','CASCADE','CASCADE');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        //
    }
}
