<?php namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    // Menampilkan daftar semua kategori
    public function index()
    {
        $data = [
            'title' => 'Daftar Kategori',
            'categories' => $this->categoryModel->orderBy('name', 'ASC')->findAll()
        ];
        return view('categories/index', $data);
    }
    
    // Menampilkan form untuk menambah kategori baru
    public function new()
    {
        $data = [
            'title' => 'Tambah Kategori Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('categories/new', $data);
    }

    // Menyimpan data kategori baru ke database
    public function create()
    {
        // Aturan validasi
        if (!$this->validate(['name' => 'required|is_unique[categories.name]'])) {
            return redirect()->to('/categories/new')->withInput();
        }

        // Simpan data
        $this->categoryModel->save(['name' => $this->request->getVar('name')]);
        
        // Set pesan sukses
        session()->setFlashdata('success', 'Kategori baru berhasil ditambahkan.');
        
        return redirect()->to('/categories');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kategori',
            'validation' => \Config\Services::validation(),
            'category' => $this->categoryModel->find($id)
        ];
        return view('categories/edit', $data);
    }

    // Mengupdate data kategori di database
    public function update($id)
    {
        // Cek nama kategori lama
        $oldCategory = $this->categoryModel->find($id);
        $rule_name = ($oldCategory['name'] == $this->request->getVar('name')) ? 'required' : 'required|is_unique[categories.name]';
        
        // Aturan validasi
        if (!$this->validate(['name' => $rule_name])) {
            return redirect()->to('/categories/edit/' . $id)->withInput();
        }

        // Update data
        $this->categoryModel->update($id, ['name' => $this->request->getVar('name')]);
        
        // Set pesan sukses
        session()->setFlashdata('success', 'Kategori berhasil diubah.');
        
        return redirect()->to('/categories');
    }
    
    // Menghapus data kategori
    public function delete($id)
    {
        try {
            $this->categoryModel->delete($id);
            session()->setFlashdata('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani error jika kategori terikat oleh foreign key di tabel products
            session()->setFlashdata('error', 'Tidak dapat menghapus kategori karena sedang digunakan oleh data produk.');
        }
        
        return redirect()->to('/categories');
    }
}