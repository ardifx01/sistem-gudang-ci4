<?php namespace App\Models;

use CodeIgniter\Model;

class PurchaseDetailModel extends Model
{
    protected $table            = 'purchase_details';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['purchase_id', 'product_id', 'quantity', 'price'];
    protected $useTimestamps    = false;

    /* MENU BARANG MASUK - incoming create*
     * Mengambil semua detail pembelian berdasarkan ID pembelian.
     * @param int $purchaseId ID dari transaksi pembelian.
     * @return array
     */
    public function getDetailsByPurchaseId(int $purchaseId): array
    {
        return $this->where('purchase_id', $purchaseId)->findAll();
    }
    
    /* MENU PEMBELIAN - show()*
     * Mengambil detail pembelian beserta data produk terkait.
     * @param int $purchaseId ID dari transaksi pembelian.
     * @return array
     */
    public function getPurchaseDetails($purchaseId)
    {
        return $this->db->table('purchase_details')
            ->join('products', 'products.id = purchase_details.product_id')
            ->where('purchase_id', $purchaseId)
            ->select('purchase_details.*, products.name as product_name, products.code as product_code')
            ->get()->getResultArray();
    }

    
}