<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\IncomingTransactionModel;
use App\Models\OutgoingTransactionModel;
use App\Models\CategoryModel; 

class DashboardController extends BaseController
{
    protected $productModel;
    protected $incomingModel;
    protected $outgoingModel;
    protected $categoryModel; 

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->incomingModel = new IncomingTransactionModel();
        $this->outgoingModel = new OutgoingTransactionModel();
        $this->categoryModel = new CategoryModel(); 
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menu'  => 'dashboard',
            'total_products' => $this->productModel->getTotalProducts(),
            'incoming_today' => $this->incomingModel->getIncomingCountByDate(),
            'outgoing_today' => $this->outgoingModel->getOutgoingCountByDate(),
            'total_categories' => $this->categoryModel->getTotalCategories(),
            'low_stock_products' => $this->productModel->getLowStockProducts()
        ];

        return view('dashboard/index', $data);
    }
}