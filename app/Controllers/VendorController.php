<?php namespace App\Controllers;

use App\Models\VendorModel;
use App\Models\PurchaseModel;

class VendorController extends BaseController
{
    protected $vendorModel;
    protected $purchaseModel;

    public function __construct()
    {
        $this->vendorModel = new VendorModel();
        $this->purchaseModel = new PurchaseModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Vendor',
            'menu' => 'vendors',
            'vendors' => $this->vendorModel->orderBy('name', 'ASC')->findAll()
        ];
        return view('vendors/index', $data);
    }
    
    public function new()
    {
        $data = [
            'title' => 'Tambah',
            'menu' => 'vendors'
        ];
        return view('vendors/new', $data);
    }

    public function create()
    {
        if (!$this->validate($this->_getValidationRules())) {
            return redirect()->back()->withInput();
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
        $vendor = $this->vendorModel->find($id);
        if (empty($vendor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Vendor dengan ID ' . $id . ' tidak ditemukan.');
        }
        $data = [
            'title' => 'Edit',
            'menu' => 'vendors',
            'vendor' => $vendor
        ];
        return view('vendors/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->_getValidationRules())) {
            return redirect()->back()->withInput();
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
        $vendorInPurchase = $this->purchaseModel->where('vendor_id', $id)->countAllResults();

        if ($vendorInPurchase > 0) {
            // Jika ada pembelian, jangan hapus dan beri pesan error
            session()->setFlashdata('error', 'Vendor tidak dapat dihapus karena terdapat di data ' . $vendorInPurchase . ' pembelian.');
            return redirect()->to('/vendors');
        }

        // Jika tidak ada pembelian, baru hapus
        if ($this->vendorModel->delete($id)) {
            session()->setFlashdata('success', 'Vendor berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus vendor.');
        }
        
        return redirect()->to('/vendors');
    }

    private function _getValidationRules(): array
    {
        return [
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama vendor wajib diisi.'
                ],
            ],
            'address' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat vendor wajib diisi.'
                ],
            ],
            'phone' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'No HP vendor wajib diisi.'
                ],
            ],
        ];
    }
}