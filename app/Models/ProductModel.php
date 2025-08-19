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

    // Method untuk mendapatkan data produk bersama dengan nama kategorinya
    public function getProductsWithCategory()
    {
        return $this->db->table('products')
            ->join('categories', 'categories.id = products.category_id')
            ->select('products.*, categories.name as category_name')
            ->orderBy('products.name', 'ASC')
            ->get()->getResultArray();
    }
}