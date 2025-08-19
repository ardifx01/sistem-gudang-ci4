<?php namespace App\Models;

use CodeIgniter\Model;

class IncomingTransactionModel extends Model
{
    protected $table            = 'incoming_transactions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['purchase_id', 'product_id', 'quantity', 'incoming_date'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Tidak ada updated_at untuk transaksi
}