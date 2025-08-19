<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToPurchases extends Migration
{
    public function up()
    {
        $this->forge->addColumn('purchases', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Pending', 'Selesai'],
                'default' => 'Pending',
                'after' => 'buyer_name',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('purchases', 'status');
    }
}
