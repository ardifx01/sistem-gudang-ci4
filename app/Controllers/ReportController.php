<?php namespace App\Controllers;

use App\Models\IncomingTransactionModel;
use App\Models\OutgoingTransactionModel;
use App\Models\ProductModel;

class ReportController extends BaseController
{
    protected $incomingModel;
    protected $outgoingModel;
    protected $productModel;

    public function __construct()
    {
        $this->incomingModel = new IncomingTransactionModel();
        $this->outgoingModel = new OutgoingTransactionModel();
        $this->productModel = new ProductModel();
    }

    /**
     * Menampilkan laporan barang masuk dengan filter tanggal.
     */
    public function incoming()
    {
        // Ambil tanggal dari input GET, jika tidak ada, default ke bulan ini
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        // Panggil metode dari model untuk mendapatkan data laporan
        $transactions = $this->incomingModel->getIncomingReport($startDate, $endDate);

        // Hitung total kuantitas
        $totalQuantity = array_sum(array_column($transactions, 'quantity'));

        $data = [
            'title' => 'Laporan Barang Masuk',
            'menu'      => 'reports',
            'submenu'   => 'reports_incoming',
            'transactions' => $transactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalQuantity' => $totalQuantity
        ];
        return view('reports/incoming', $data);
    }

    /**
     * Menampilkan laporan barang keluar dengan filter tanggal.
     */
    public function outgoing()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');
        
        // Panggil metode dari model untuk mendapatkan data laporan
        $transactions = $this->outgoingModel->getOutgoingReport($startDate, $endDate);
        
        // Hitung total kuantitas
        $totalQuantity = array_sum(array_column($transactions, 'quantity'));
        
        $data = [
            'title' => 'Laporan Barang Keluar',
            'menu'      => 'reports',
            'submenu'   => 'reports_outgoing',
            'transactions' => $transactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalQuantity' => $totalQuantity
        ];
        return view('reports/outgoing', $data);
    }

    /**
     * Menampilkan laporan stok barang terkini.
     */
    public function stock()
    {
        // Panggil metode dari model untuk mendapatkan data
        $products = $this->productModel->getProductsWithCategory();
        $data = [
            'title' => 'Laporan Stok',
            'menu'      => 'reports',
            'submenu'   => 'reports_stock',
            'products' => $products
        ];
        return view('reports/stock', $data);
    }
}