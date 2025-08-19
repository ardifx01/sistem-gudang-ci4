<?php namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\PurchaseDetailModel;
use App\Models\VendorModel;
use App\Models\ProductModel;

class PurchaseController extends BaseController
{
    public function index()
    {
        $purchaseModel = new PurchaseModel();
        $data = [
            'title' => 'Daftar Transaksi Pembelian',
            'purchases' => $purchaseModel->getPurchasesWithVendor()
        ];
        return view('purchases/index', $data);
    }
    
    public function show($id)
    {
        $purchaseModel = new PurchaseModel();
        $purchaseDetailModel = new PurchaseDetailModel();
        
        $purchase = $purchaseModel->getPurchasesWithVendor($id);
        
        $data = [
            'title' => 'Detail Pembelian',
            'purchase' => $purchaseModel->select('purchases.*, vendors.name as vendor_name')->join('vendors', 'vendors.id = purchases.vendor_id')->where('purchases.id', $id)->first(),
            'details' => $purchaseDetailModel->getPurchaseDetails($id)
        ];
        return view('purchases/show', $data);
    }

    public function new()
    {
        $vendorModel = new VendorModel();
        $productModel = new ProductModel();

        $data = [
            'title' => 'Buat Transaksi Pembelian',
            'vendors' => $vendorModel->orderBy('name', 'ASC')->findAll(),
            'products' => $productModel->orderBy('name', 'ASC')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('purchases/new', $data);
    }

    public function create()
    {
        $rules = [
            'vendor_id' => 'required',
            'purchase_date' => 'required|valid_date',
            'buyer_name' => 'required',
            'products' => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('/purchases/new')->withInput();
        }

        $db = \Config\Database::connect();
        $db->transStart();
        
        try {
            $purchaseModel = new PurchaseModel();
            $purchaseDetailModel = new PurchaseDetailModel();

            $purchaseModel->save([
                'vendor_id' => $this->request->getVar('vendor_id'),
                'purchase_date' => $this->request->getVar('purchase_date'),
                'buyer_name' => $this->request->getVar('buyer_name'),
            ]);
            $purchaseId = $purchaseModel->getInsertID();
            
            $totalAmount = 0;
            $products = $this->request->getVar('products');

            foreach ($products as $product) {
                if (empty($product['product_id']) || empty($product['quantity']) || empty($product['price'])) {
                    continue; // Lewati baris yang tidak lengkap
                }
                $purchaseDetailModel->save([
                    'purchase_id' => $purchaseId,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                ]);
                $totalAmount += $product['quantity'] * $product['price'];
            }
            
            $purchaseModel->update($purchaseId, ['total_amount' => $totalAmount]);

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