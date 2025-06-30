<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFeedbackToMaintenanceRequests extends Migration
{
    public function up()
    {
        $this->forge->addColumn('maintenance_requests', [
            'feedback' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'status', // optional
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('maintenance_requests', 'feedback');
    }
}
