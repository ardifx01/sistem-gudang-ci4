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

    /* MENU BARANG MASUK - Index*
     * Metode untuk mengambil semua data transaksi keluar bersama dengan detail produk.
     * Menggunakan Query Builder dari Model.
     *
     * @return array Array berisi data transaksi keluar dengan detail produk.
     */
    public function getOutgoingTransactions(): array
    {
        return $this->join('products', 'products.id = outgoing_transactions.product_id')
                    ->select('outgoing_transactions.*, products.name as product_name, products.code as product_code')
                    ->orderBy('outgoing_transactions.outgoing_date', 'DESC')
                    ->findAll();
    }

    /* LAPORAN BARANG KELUAR - report*
     * Mengambil transaksi barang keluar dengan filter tanggal.
     * @param string $startDate Tanggal awal (format YYYY-MM-DD).
     * @param string $endDate Tanggal akhir (format YYYY-MM-DD).
     * @return array
     */
    public function getOutgoingReport(string $startDate, string $endDate)
    {
        return $this->join('products', 'products.id = outgoing_transactions.product_id')
                    ->where('outgoing_date >=', $startDate)
                    ->where('outgoing_date <=', $endDate)
                    ->select('outgoing_transactions.*, products.name as product_name, products.code as product_code')
                    ->orderBy('outgoing_transactions.outgoing_date', 'DESC')
                    ->findAll();
    }

    /* DASHBOARD - Barang Keluar *
     * Menghitung jumlah transaksi barang keluar untuk tanggal tertentu.
     * @param string $date Tanggal untuk dihitung (format YYYY-MM-DD). Default hari ini.
     * @return int
     */
    public function getOutgoingCountByDate(string $date = null): int
    {
        $date = $date ?? date('Y-m-d');
        return $this->where('DATE(outgoing_date)', $date)->countAllResults();
    }
}