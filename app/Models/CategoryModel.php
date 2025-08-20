<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /* DASHBOARD - Total Kategori *
     * Mengambil jumlah total kategori.
     * @return int
     */
    public function getTotalCategories(): int
    {
        return $this->countAllResults();
    }
}