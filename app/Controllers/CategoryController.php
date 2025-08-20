<?php namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class CategoryController extends BaseController
{
    protected $categoryModel;
    protected $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'menu' => 'categories',
            'categories' => $this->categoryModel->orderBy('name', 'ASC')->findAll()
        ];
        return view('categories/index', $data);
    }
 
    public function new()
    {
        $data = [
            'title' => 'Tambah',
            'menu' => 'categories',
        ];
        return view('categories/new', $data);
    }

    public function create()
    {
        $rules = [
            'name' => [
                'rules' => 'required|is_unique[categories.name]',
                'errors' => [
                    'required' => 'Nama kategori wajib diisi.',
                    'is_unique' => 'Nama kategori sudah ada, silakan gunakan nama lain.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->categoryModel->save(['name' => $this->request->getVar('name')]);
        session()->setFlashdata('success', 'Kategori baru berhasil ditambahkan.');
        
        return redirect()->to('/categories');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $data = [
            'title' => 'Edit',
            'menu' => 'categories',
            'category' => $this->categoryModel->find($id)
        ];
        return view('categories/edit', $data);
    }

    // Mengupdate data kategori di database
    public function update($id)
    {
        $rules = [
            'name' => [
                'rules' => "required|is_unique[categories.name,id,{$id}]",
                'errors' => [
                    'required'  => 'Nama kategori wajib diisi.',
                    'is_unique' => 'Nama kategori sudah ada, silakan gunakan nama lain.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        // Update data
        $this->categoryModel->update($id, [
            'name' => $this->request->getVar('name')
        ]);
        
        // Set pesan sukses
        session()->setFlashdata('success', 'Kategori berhasil diubah.');
        
        return redirect()->to('/categories');
    }
    
    // Menghapus data kategori
    public function delete($id)
    {
        $productsInCategory = $this->productModel->where('category_id', $id)->countAllResults();

        if ($productsInCategory > 0) {
            // Jika ada produk, jangan hapus dan beri pesan error
            session()->setFlashdata('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh ' . $productsInCategory . ' produk.');
            return redirect()->to('/categories');
        }

        // Jika tidak ada produk, baru hapus
        if ($this->categoryModel->delete($id)) {
            session()->setFlashdata('success', 'Kategori berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus kategori.');
        }
        
        return redirect()->to('/categories');
    }
}