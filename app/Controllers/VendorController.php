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
        $rules = [
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

        if (! $this->validate($rules)) {
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
        $data = [
            'title' => 'Edit',
            'menu' => 'vendors',
            'vendor' => $this->vendorModel->find($id)
        ];
        return view('vendors/edit', $data);
    }

    public function update($id)
    {
        $rules = [
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
        
        if (! $this->validate($rules)) {
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
}