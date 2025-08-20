<?php namespace App\Controllers;

use App\Models\IncomingTransactionModel;
use App\Models\PurchaseModel;
use App\Models\PurchaseDetailModel;
use App\Models\ProductModel;

class IncomingController extends BaseController
{
    // Deklarasikan semua model yang dibutuhkan sebagai properti class
    protected $incomingModel;
    protected $purchaseModel;
    protected $purchaseDetailModel;
    protected $productModel;

    // Inisialisasi semua model sekali saja di dalam constructor
    public function __construct()
    {
        $this->incomingModel = new IncomingTransactionModel();
        $this->purchaseModel = new PurchaseModel();
        $this->purchaseDetailModel = new PurchaseDetailModel();
        $this->productModel = new ProductModel();
    }

    /**
     * Menampilkan daftar pembelian yang statusnya 'Pending' (siap diterima).
     */
    public function index()
    {
        $data = [
            'title' => 'Barang Masuk',
            'menu'    => 'transaksi',
            'submenu' => 'incoming',
            'purchases' => $this->purchaseModel->where('status', 'Pending')->getPurchasesWithVendor()->findAll()
        ];
        return view('incoming/index', $data);
    }

    /**
     * Menampilkan halaman konfirmasi untuk satu pembelian spesifik.
     */
    public function process($purchaseId)
    {
        $data = [
            'title' => 'Proses',
            'menu'    => 'transaksi',
            'submenu' => 'incoming',
            'purchase' => $this->purchaseModel->select('purchases.*, vendors.name as vendor_name')->join('vendors', 'vendors.id = purchases.vendor_id')->where('purchases.id', $purchaseId)->first(),
            'details' => $this->purchaseDetailModel->getPurchaseDetails($purchaseId)
        ];

        // Cek jika data pembelian tidak ditemukan
        if (empty($data['purchase'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pembelian tidak ditemukan.');
        }

        return view('incoming/process', $data);
    }

    /**
     * Memproses data: menambah stok, menyimpan catatan transaksi,
     * dan mengubah status pembelian.
     */
    public function create()
    {
        $purchaseId = $this->request->getVar('purchase_id');
        $details = $this->purchaseDetailModel->where('purchase_id', $purchaseId)->findAll();

        // Pastikan ada detail barang sebelum melanjutkan
        if (empty($details)) {
            session()->setFlashdata('error', 'Tidak ada detail barang untuk diproses.');
            return redirect()->to('/incoming');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            foreach ($details as $item) {
                // 1. Tambah stok di tabel products
                $this->productModel->set('stock', "stock + {$item['quantity']}", false)
                                   ->where('id', $item['product_id'])
                                   ->update();

                // 2. Simpan ke tabel incoming_transactions
                $this->incomingModel->save([
                    'purchase_id' => $purchaseId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'incoming_date' => date('Y-m-d')
                ]);
            }
            
            // 3. Update status pembelian menjadi 'Selesai'
            $this->purchaseModel->update($purchaseId, ['status' => 'Selesai']);

            $db->transComplete();
            session()->setFlashdata('success', 'Barang masuk berhasil diproses dan stok telah diperbarui.');

        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', 'Gagal memproses barang masuk: ' . $e->getMessage());
        }
        
        return redirect()->to('/incoming');
    }
}