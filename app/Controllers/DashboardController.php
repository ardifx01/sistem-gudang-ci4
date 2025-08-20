<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\VendorModel;
use App\Models\IncomingTransactionModel;
use App\Models\OutgoingTransactionModel;

class DashboardController extends BaseController
{
    public function index()
    {
        // Inisialisasi semua model yang dibutuhkan
        $productModel = new ProductModel();
        $vendorModel = new VendorModel();
        $incomingModel = new IncomingTransactionModel();
        $outgoingModel = new OutgoingTransactionModel();

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Dashboard',
            'menu'  => 'dashboard',
            'total_products' => $productModel->countAllResults(),
            'total_vendors' => $vendorModel->countAllResults(),
            'incoming_today' => $incomingModel->where('DATE(incoming_date)', date('Y-m-d'))->countAllResults(),
            'outgoing_today' => $outgoingModel->where('DATE(outgoing_date)', date('Y-m-d'))->countAllResults(),
            'low_stock_products' => $productModel->where('stock <=', 5)->orderBy('stock', 'ASC')->limit(5)->findAll()
        ];

        return view('dashboard/index', $data);
    }
}