<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToMaintenanceRequests extends Migration
{
    public function up()
    {
        $this->forge->addColumn('maintenance_requests', [
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'feedback', // or any column you prefer
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('maintenance_requests', 'image');
    }
}
