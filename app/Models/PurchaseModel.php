<?php namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table            = 'purchases';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['vendor_id', 'purchase_date', 'total_amount', 'buyer_name', 'status'];
    protected $useTimestamps    = true;

    public function getPurchasesWithVendor()
    {
        // return $this->db->table('purchases')
        //     ->join('vendors', 'vendors.id = purchases.vendor_id')
        //     ->select('purchases.*, vendors.name as vendor_name')
        //     ->orderBy('purchases.purchase_date', 'DESC')
        //     ->get()->getResultArray();

        return $this->join('vendors', 'vendors.id = purchases.vendor_id')
                ->select('purchases.*, vendors.name as vendor_name')
                ->orderBy('purchases.purchase_date', 'DESC')
                ->orderBy('purchases.status', 'ASC');
    }
}