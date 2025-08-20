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
        if (!$this->validate($this->_getValidationRules())) {
            return redirect()->back()->withInput();
        }

        $this->categoryModel->save(['name' => $this->request->getVar('name')]);
        session()->setFlashdata('success', 'Kategori baru berhasil ditambahkan.');
        
        return redirect()->to('/categories');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        if (empty($category)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }
        $data = [
            'title' => 'Edit',
            'menu' => 'categories',
            'category' => $category
        ];
        return view('categories/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->_getValidationRules($id))) {
            return redirect()->back()->withInput();
        }

        $this->categoryModel->update($id, [
            'name' => $this->request->getVar('name')
        ]);
        
        session()->setFlashdata('success', 'Kategori berhasil diubah.');
        
        return redirect()->to('/categories');
    }
    
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

    private function _getValidationRules(?string $id = null): array
    {
        $uniqueRule = 'is_unique[categories.name]';
        if ($id) {
            $uniqueRule = "is_unique[categories.name,id,{$id}]";
        }

        return [
            'name' => [
                'rules' => 'required|' . $uniqueRule,
                'errors' => [
                    'required' => 'Nama kategori wajib diisi.',
                    'is_unique' => 'Nama kategori sudah ada, silakan gunakan nama lain.'
                ]
            ]
        ];
    }

}