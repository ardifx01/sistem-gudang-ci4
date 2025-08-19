<?php namespace App\Controllers;

use App\Models\IncomingTransactionModel;
use App\Models\OutgoingTransactionModel;
use App\Models\ProductModel;

class ReportController extends BaseController
{
    /**
     * Menampilkan laporan barang masuk dengan filter tanggal.
     */
    public function incoming()
    {
        $incomingModel = new IncomingTransactionModel();
        
        // Ambil tanggal dari input GET, jika tidak ada, default ke bulan ini
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        $transactions = $incomingModel
            ->join('products', 'products.id = incoming_transactions.product_id')
            ->where('incoming_date >=', $startDate)
            ->where('incoming_date <=', $endDate)
            ->select('incoming_transactions.*, products.name as product_name, products.code as product_code')
            ->orderBy('incoming_transactions.incoming_date', 'DESC')
            ->findAll();

        // TAMBAHKAN INI: Hitung total kuantitas
        $totalQuantity = array_sum(array_column($transactions, 'quantity'));

        $data = [
            'title' => 'Laporan Barang Masuk',
            'transactions' => $transactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalQuantity' => $totalQuantity // Kirim total ke view
        ];
        return view('reports/incoming', $data);
    }

    /**
     * Menampilkan laporan barang keluar dengan filter tanggal.
     */
    public function outgoing()
    {
        $outgoingModel = new OutgoingTransactionModel();
        
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');
        
        $transactions = $outgoingModel
            ->join('products', 'products.id = outgoing_transactions.product_id')
            ->where('outgoing_date >=', $startDate)
            ->where('outgoing_date <=', $endDate)
            ->select('outgoing_transactions.*, products.name as product_name, products.code as product_code')
            ->orderBy('outgoing_transactions.outgoing_date', 'DESC')
            ->findAll();
        
        // TAMBAHKAN INI: Hitung total kuantitas
        $totalQuantity = array_sum(array_column($transactions, 'quantity'));
        $data = [
            'title' => 'Laporan Barang Keluar',
            'transactions' => $transactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalQuantity' => $totalQuantity // Kirim total ke view
        ];
        return view('reports/outgoing', $data);
    }

    /**
     * Menampilkan laporan stok barang terkini.
     */
    public function stock()
    {
        $productModel = new ProductModel();
        $data = [
            'title' => 'Laporan Stok Barang Terkini',
            'products' => $productModel->getProductsWithCategory()
        ];
        return view('reports/stock', $data);
    }
}