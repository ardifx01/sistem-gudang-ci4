<?php namespace App\Models;

use CodeIgniter\Model;

class OutgoingTransactionModel extends Model
{
    protected $table            = 'outgoing_transactions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['product_id', 'quantity', 'outgoing_date', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Tidak ada updated_at untuk transaksi

    // Method untuk mengambil data transaksi keluar bersama dengan detail produk
    public function getOutgoingTransactions()
    {
        return $this->db->table('outgoing_transactions')
            ->join('products', 'products.id = outgoing_transactions.product_id')
            ->select('outgoing_transactions.*, products.name as product_name, products.code as product_code')
            ->orderBy('outgoing_transactions.outgoing_date', 'DESC')
            ->get()->getResultArray();
    }
}