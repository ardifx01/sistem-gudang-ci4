<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['category_id', 'code', 'name', 'unit', 'stock'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /* MENU BARANG MASUK - incoming create*
     * Menambah stok barang berdasarkan ID.
     * @param int $productId ID produk yang akan diperbarui.
     * @param int $quantity Jumlah yang akan ditambahkan.
     * @return bool
     */
    public function increaseStock(int $productId, int $quantity): bool
    {
        return $this->set('stock', 'stock + ' . $this->db->escape($quantity), false)
                    ->where('id', $productId)
                    ->update();
    }
    
    /* MENU BARANG - index*
     * Metode untuk mendapatkan data produk bersama dengan nama kategorinya.
     * Menggunakan Query Builder dari Model untuk DRY (Don't Repeat Yourself).
     *
     * @return array Array berisi data produk dengan nama kategori.
     */
    public function getProductsWithCategory(): array
    {
        return $this->join('categories', 'categories.id = products.category_id')
                    ->select('products.*, categories.name as category_name')
                    ->orderBy('products.stock', 'ASC')
                    ->findAll();
    }

    /* DASHBOARD - Total Jenis Barang *
     * Mengambil jumlah total jenis produk.
     * @return int
     */
    public function getTotalProducts(): int
    {
        return $this->countAllResults();
    }

    /* DASHBOARD - Reminder Stok Barang *
     * Mengambil daftar produk dengan stok menipis (<= jumlah tertentu).
     * @param int $threshold Batas stok minimum. Default 5.
     * @param int $limit Batas jumlah hasil. Default 5.
     * @return array
     */
    public function getLowStockProducts(int $threshold = 5, int $limit = 5): array
    {
        return $this->where('stock <=', $threshold)
                    ->orderBy('stock', 'ASC')
                    ->limit($limit)
                    ->findAll();
    }
}