<?php namespace App\Controllers;

use App\Models\VendorModel;

class VendorController extends BaseController
{
    protected $vendorModel;

    public function __construct()
    {
        $this->vendorModel = new VendorModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Vendor',
            'vendors' => $this->vendorModel->orderBy('name', 'ASC')->findAll()
        ];
        return view('vendors/index', $data);
    }
    
    public function new()
    {
        $data = [
            'title' => 'Tambah Vendor Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('vendors/new', $data);
    }

    public function create()
    {
        if (!$this->validate(['name' => 'required'])) {
            return redirect()->to('/vendors/new')->withInput();
        }

        $this->vendorModel->save([
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
        ]);
        session()->setFlashdata('success', 'Vendor baru berhasil ditambahkan.');
        return redirect()->to('/vendors');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Vendor',
            'validation' => \Config\Services::validation(),
            'vendor' => $this->vendorModel->find($id)
        ];
        return view('vendors/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate(['name' => 'required'])) {
            return redirect()->to('/vendors/edit/' . $id)->withInput();
        }

        $this->vendorModel->update($id, [
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
        ]);
        session()->setFlashdata('success', 'Data vendor berhasil diubah.');
        return redirect()->to('/vendors');
    }
    
    public function delete($id)
    {
        try {
            $this->vendorModel->delete($id);
            session()->setFlashdata('success', 'Data vendor berhasil dihapus.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menghapus vendor, kemungkinan masih terikat dengan data pembelian.');
        }
        return redirect()->to('/vendors');
    }
}