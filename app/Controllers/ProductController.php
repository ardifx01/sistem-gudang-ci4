<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\IncomingTransactionModel;
use App\Models\OutgoingTransactionModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $incomingModel;
    protected $outgoingModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->incomingModel = new IncomingTransactionModel();
        $this->outgoingModel = new OutgoingTransactionModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang',
            'menu' => 'products',
            'products' => $this->productModel->getProductsWithCategory()
        ];
        return view('products/index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah',
            'menu' => 'products',
            'categories' => $this->categoryModel->findAll()
        ];
        return view('products/new', $data);
    }

    public function create()
    {
        if (!$this->validate($this->_getValidationRules())) {
            return redirect()->back()->withInput();
        }

        $this->productModel->save([
            'name' => $this->request->getVar('name'),
            'code' => $this->request->getVar('code'),
            'category_id' => $this->request->getVar('category_id'),
            'unit' => $this->request->getVar('unit'),
            'stock' => $this->request->getVar('stock')
        ]);

        session()->setFlashdata('success', 'Barang baru berhasil ditambahkan.');
        return redirect()->to('/products');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        $categories = $this->categoryModel->findAll();
        if (empty($product)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Barang dengan ID ' . $id . ' tidak ditemukan.');
        }
        $data = [
            'title' => 'Edit',
            'menu' => 'products',
            'product' => $product,
            'categories' => $categories
        ];
        return view('products/edit', $data);
    }

    public function update($id)
    {   
        if (!$this->validate($this->_getValidationRules($id))) {
            return redirect()->back()->withInput();
        }

        $this->productModel->update($id, [
            'name' => $this->request->getVar('name'),
            'code' => $this->request->getVar('code'),
            'category_id' => $this->request->getVar('category_id'),
            'unit' => $this->request->getVar('unit'),
            'stock' => $this->request->getVar('stock')
        ]);

        session()->setFlashdata('success', 'Data barang berhasil diubah.');
        return redirect()->to('/products');
    }

    public function delete($id)
    {
        // Cek apakah produk ini pernah digunakan di transaksi
        // PERBAIKAN: Gunakan $this-> untuk mengakses model
        $incomingCount = $this->incomingModel->where('product_id', $id)->countAllResults();
        $outgoingCount = $this->outgoingModel->where('product_id', $id)->countAllResults();

        // Jika produk sudah pernah digunakan (ada riwayat transaksi)
        if ($incomingCount > 0 || $outgoingCount > 0) {
            // Langsung kirim notifikasi error sederhana dan kembali.
            session()->setFlashdata('error', 'Produk tidak dapat dihapus karena datanya sudah digunakan.');
            return redirect()->to('/products');
        }

        // Jika aman, baru lanjutkan proses hapus
        if ($this->productModel->delete($id)) {
            session()->setFlashdata('success', 'Data barang berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data barang.');
        }
        
        return redirect()->to('/products');
    }

    private function _getValidationRules(?string $id = null): array
    {
        // Aturan unique untuk kode produk disesuaikan jika ini adalah operasi update
        $codeUniqueRule = 'is_unique[products.code]';
        if ($id) {
            $codeUniqueRule = "is_unique[products.code,id,{$id}]";
        }

        return [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi.'
                ]
            ],
            'code' => [
                'rules' => 'required|' . $codeUniqueRule,
                'errors' => [
                    'required' => 'Kode barang wajib diisi.',
                    'is_unique' => 'Kode barang ini sudah terdaftar. Silakan gunakan kode lain.'
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori barang harus dipilih.'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan barang (unit) harus diisi.'
                ]
            ],
            'stock' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Jumlah stok awal harus diisi.',
                    'numeric' => 'Stok harus berupa angka.',
                    'greater_than_equal_to' => 'Jumlah stok tidak boleh kurang dari 0.'
                ]
            ]
        ];
    }
}