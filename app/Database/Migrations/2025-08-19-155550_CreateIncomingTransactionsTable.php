<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIncomingTransactionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'purchase_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Bisa null jika barang masuk tanpa pembelian
            'product_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'quantity' => ['type' => 'INT', 'constraint' => 11],
            'incoming_date' => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('purchase_id', 'purchases', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('incoming_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('incoming_transactions');
    }
}
