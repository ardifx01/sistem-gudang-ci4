<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOutgoingTransactionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'product_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'quantity' => ['type' => 'INT', 'constraint' => 11],
            'outgoing_date' => ['type' => 'DATE'],
            'description' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('outgoing_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('outgoing_transactions');
    }
}
