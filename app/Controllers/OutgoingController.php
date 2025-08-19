<?php namespace App\Controllers;

use App\Models\OutgoingTransactionModel;
use App\Models\ProductModel;

class OutgoingController extends BaseController
{
    protected $outgoingModel;
    protected $productModel;

    public function __construct()
    {
        $this->outgoingModel = new OutgoingTransactionModel();
        $this->productModel = new ProductModel();
    }

    // Menampilkan daftar transaksi barang keluar
    public function index()
    {
        $data = [
            'title' => 'Daftar Transaksi Barang Keluar',
            'transactions' => $this->outgoingModel->getOutgoingTransactions()
        ];
        return view('outgoing/index', $data);
    }
    
    // Menampilkan form untuk mencatat transaksi baru
    public function new()
    {
        $data = [
            'title' => 'Catat Barang Keluar',
            'products' => $this->productModel->orderBy('name', 'ASC')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('outgoing/new', $data);
    }

    // Memproses penyimpanan transaksi baru
    public function create()
    {
        // Aturan validasi input
        $rules = [
            'product_id' => 'required',
            'quantity' => 'required|numeric|greater_than[0]',
            'outgoing_date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/outgoing/new')->withInput();
        }

        $productId = $this->request->getVar('product_id');
        $quantity = (int)$this->request->getVar('quantity');
        
        $product = $this->productModel->find($productId);

        // Validasi kedua: cek apakah stok mencukupi
        if (!$product || $product['stock'] < $quantity) {
            session()->setFlashdata('error', 'Stok tidak mencukupi untuk barang yang dipilih.');
            return redirect()->to('/outgoing/new')->withInput();
        }

        // Gunakan Database Transaction untuk keamanan data
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // 1. Kurangi stok di tabel products
            $newStock = $product['stock'] - $quantity;
            $this->productModel->update($productId, ['stock' => $newStock]);
            
            // 2. Simpan catatan transaksi di tabel outgoing_transactions
            $this->outgoingModel->save([
                'product_id' => $productId,
                'quantity' => $quantity,
                'outgoing_date' => $this->request->getVar('outgoing_date'),
                'description' => $this->request->getVar('description'),
            ]);
            
            // Jika semua query berhasil, commit transaksi
            $db->transComplete();

            session()->setFlashdata('success', 'Transaksi barang keluar berhasil dicatat.');
            return redirect()->to('/outgoing');

        } catch (\Exception $e) {
            // Jika salah satu query gagal, batalkan semua perubahan
            $db->transRollback();
            session()->setFlashdata('error', 'Gagal mencatat transaksi: ' . $e->getMessage());
            return redirect()->to('/outgoing/new')->withInput();
        }
    }
}