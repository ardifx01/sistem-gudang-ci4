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

    public function index()
    {
        $data = [
            'title' => 'Barang Keluar',
            'menu'    => 'transaksi',
            'submenu' => 'outgoing',
            'transactions' => $this->outgoingModel->getOutgoingTransactions()
        ];
        return view('outgoing/index', $data);
    }
    
    public function new()
    {
        $data = [
            'title' => 'Tambah',
            'menu'    => 'transaksi',
            'submenu' => 'outgoing',
            'products' => $this->productModel->orderBy('name', 'ASC')->findAll()
        ];
        return view('outgoing/new', $data);
    }

    public function create()
    {
        if (!$this->validate($this->_getValidationRules())) {
            return redirect()->back()->withInput();
        }

        $productId = $this->request->getVar('product_id');
        $quantity = (int)$this->request->getVar('quantity');
        
        $product = $this->productModel->find($productId);

        // Validasi cek apakah stok mencukupi
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

    private function _getValidationRules(): array
    {
        return [
            'product_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Produk harus dipilih.'
                ]
            ],
            'quantity' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required'     => 'Jumlah barang wajib diisi.',
                    'numeric'      => 'Jumlah harus berupa angka.',
                    'greater_than' => 'Jumlah harus lebih dari 0.'
                ]
            ],
            'outgoing_date' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required'   => 'Tanggal keluar barang wajib diisi.',
                    'valid_date' => 'Format tanggal tidak valid.'
                ]
            ]
        ];
    }
}