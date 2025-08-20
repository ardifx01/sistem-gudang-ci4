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

    /* LAPORAN BARANG MASUK - report*
     * Mengambil transaksi barang masuk dengan filter tanggal.
     * @param string $startDate Tanggal awal (format YYYY-MM-DD).
     * @param string $endDate Tanggal akhir (format YYYY-MM-DD).
     * @return array
     */
    public function getIncomingReport(string $startDate, string $endDate)
    {
        return $this->join('products', 'products.id = incoming_transactions.product_id')
                    ->where('incoming_date >=', $startDate)
                    ->where('incoming_date <=', $endDate)
                    ->select('incoming_transactions.*, products.name as product_name, products.code as product_code')
                    ->orderBy('incoming_transactions.incoming_date', 'ASC')
                    ->findAll();
    }

    /* DASHBOARD - Barang Masuk *
     * Menghitung jumlah transaksi barang masuk untuk tanggal tertentu.
     * @param string $date Tanggal untuk dihitung (format YYYY-MM-DD). Default hari ini.
     * @return int
     */
    public function getIncomingCountByDate(string $date = null): int
    {
        $date = $date ?? date('Y-m-d');
        return $this->where('DATE(incoming_date)', $date)->countAllResults();
    }

}