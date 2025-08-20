<?php namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table            = 'purchases';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['vendor_id', 'purchase_date', 'total_amount', 'buyer_name', 'status'];
    protected $useTimestamps    = true;

    public function getPendingPurchases()
    {
        return $this->where('status', 'Pending')->getPurchasesWithVendor();
    }
    
    /**
     * Mengambil daftar pembelian dengan nama vendor terkait.
     */
    public function getPurchasesWithVendor()
    {
        return $this->join('vendors', 'vendors.id = purchases.vendor_id')
                    ->select('purchases.*, vendors.name as vendor_name')
                    ->orderBy('purchases.purchase_date', 'DESC')
                    ->orderBy('purchases.status', 'ASC');
    }
    
    /**
     * Mengambil satu data pembelian berdasarkan ID, beserta nama vendor.
     * @param int $id ID dari transaksi pembelian.
     * @return array|object|null
     */
    public function getPurchaseWithVendor(int $id)
    {
        return $this->join('vendors', 'vendors.id = purchases.vendor_id')
                    ->select('purchases.*, vendors.name as vendor_name')
                    ->where('purchases.id', $id)
                    ->first();
    }
    
}