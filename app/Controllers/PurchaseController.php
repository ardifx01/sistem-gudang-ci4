<?php namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\PurchaseDetailModel;
use App\Models\VendorModel;
use App\Models\ProductModel;

class PurchaseController extends BaseController
{
    protected $purchaseModel;
    protected $purchaseDetailModel;
    protected $vendorModel;
    protected $productModel;

    public function __construct()
    {
        $this->purchaseModel = new PurchaseModel();
        $this->purchaseDetailModel = new PurchaseDetailModel();
        $this->vendorModel = new VendorModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Transaksi Pembelian',
            // PERBAIKAN DI SINI: Tambahkan ->findAll()
            'purchases' => $this->purchaseModel->getPurchasesWithVendor()->findAll()
        ];
        return view('purchases/index', $data);
    }
    
    public function show($id)
    {
        $purchase = $this->purchaseModel->select('purchases.*, vendors.name as vendor_name')->join('vendors', 'vendors.id = purchases.vendor_id')->where('purchases.id', $id)->first();

        if (empty($purchase)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pembelian dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Pembelian',
            'purchase' => $purchase,
            'details' => $this->purchaseDetailModel->getPurchaseDetails($id)
        ];
        return view('purchases/show', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Buat Transaksi Pembelian',
            'vendors' => $this->vendorModel->orderBy('name', 'ASC')->findAll(),
            'products' => $this->productModel->orderBy('name', 'ASC')->findAll()
        ];
        return view('purchases/new', $data);
    }

    public function create()
    {
        $rules = [
            'vendor_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vendor atau pemasok harus dipilih.'
                ]
            ],
            'purchase_date' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required'   => 'Tanggal pembelian wajib diisi.',
                    'valid_date' => 'Format tanggal pembelian tidak valid.'
                ]
            ],
            'buyer_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pembeli harus diisi.'
                ]
            ],
            'products' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Minimal harus ada satu produk dalam daftar pembelian.'
                ]
            ]
        ];
        
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $db = \Config\Database::connect();
        $db->transStart();
        
        try {
            $this->purchaseModel->insert([
                'vendor_id' => $this->request->getVar('vendor_id'),
                'purchase_date' => $this->request->getVar('purchase_date'),
                'buyer_name' => $this->request->getVar('buyer_name'),
                'status' => 'Pending',
            ]);
            $purchaseId = $this->purchaseModel->getInsertID();
            
            $totalAmount = 0;
            $products = $this->request->getVar('products');

            foreach ($products as $product) {
                if (empty($product['product_id']) || empty($product['quantity'])) { continue; }
                $this->purchaseDetailModel->save([
                    'purchase_id' => $purchaseId,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'] ?? 0,
                ]);
                $totalAmount += $product['quantity'] * ($product['price'] ?? 0);
            }
            
            $this->purchaseModel->update($purchaseId, ['total_amount' => $totalAmount]);

            $db->transComplete();
            session()->setFlashdata('success', 'Transaksi pembelian berhasil disimpan.');
            return redirect()->to('/purchases');

        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', 'Gagal menyimpan transaksi pembelian: ' . $e->getMessage());
            return redirect()->to('/purchases/new')->withInput();
        }
    }
}