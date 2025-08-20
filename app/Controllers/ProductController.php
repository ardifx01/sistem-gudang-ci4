<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    // Menampilkan daftar semua barang
    public function index()
    {
        $data = [
            'title' => 'Daftar Barang',
            'products' => $this->productModel->getProductsWithCategory()
        ];
        return view('products/index', $data);
    }

    // Menampilkan form untuk menambah barang baru
    public function new()
    {
        $data = [
            'title' => 'Tambah Barang Baru',
            'categories' => $this->categoryModel->findAll()
        ];
        return view('products/new', $data);
    }

    // Menyimpan data barang baru
    public function create()
    {
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi.'
                ]
            ],
            'code' => [
                'rules' => 'required|is_unique[products.code]',
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

        if (! $this->validate($rules)) {
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

    // Menampilkan form untuk mengedit barang
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Barang',
            'product' => $this->productModel->find($id),
            'categories' => $this->categoryModel->findAll()
        ];
        return view('products/edit', $data);
    }

    // Mengupdate data barang
    public function update($id)
    {   
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama produk harus diisi.'
                ]
            ],
            'code' => [
                'rules' => "required|is_unique[products.code,id,{$id}]", 
                'errors' => [
                    'required' => 'Kode barang wajib diisi.',
                    'is_unique' => 'Kode barang ini sudah terdaftar. Silakan gunakan kode lain.'
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori produk harus dipilih.'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan produk (unit) harus diisi.'
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

        if (! $this->validate($rules)) {
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

    // Menghapus data barang
    public function delete($id)
    {
        $this->productModel->delete($id);
        session()->setFlashdata('success', 'Data barang berhasil dihapus.');
        return redirect()->to('/products');
    }
}