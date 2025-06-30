<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'sender_id'    => ['type' => 'INT'],
            'receiver_id'  => ['type' => 'INT'],
            'subject'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'body'         => ['type' => 'TEXT'],
            'message_type' => ['type' => 'VARCHAR', 'constraint' => 100], // optional categorization
            'is_read'      => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('messages');
    }

    public function down()
    {
        $this->forge->dropTable('messages');
    }
}
