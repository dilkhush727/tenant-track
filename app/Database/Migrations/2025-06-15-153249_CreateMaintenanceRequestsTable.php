<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaintenanceRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>['type'=>'INT','auto_increment'=>true],
            'tenant_id'=>['type'=>'INT'],
            'property_id'=>['type'=>'INT'],
            'issue_type'=>['type'=>'VARCHAR','constraint'=>100],
            'description'=>['type'=>'TEXT'],
            'status'=>['type'=>"ENUM('submitted','in_progress','resolved')",'default'=>'submitted'],
            'submitted_at'=>['type'=>'DATETIME'],
            'resolved_at'=>['type'=>'DATETIME','null'=>true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tenant_id','users','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('property_id','properties','id','CASCADE','CASCADE');
        $this->forge->createTable('maintenance_requests');
    }

    public function down()
    {
        //
    }
}
