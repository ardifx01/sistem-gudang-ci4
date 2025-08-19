<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// Alihkan halaman utama ke halaman kategori
$routes->get('/', 'CategoryController::index');

// Definisikan rute edit dan update secara manual untuk mengatasi masalah
$routes->get('categories/edit/(:num)', 'CategoryController::edit/$1');
$routes->put('categories/(:num)', 'CategoryController::update/$1');
$routes->get('products/edit/(:num)', 'ProductController::edit/$1');
$routes->put('products/(:num)', 'ProductController::update/$1');
$routes->get('vendors/edit/(:num)', 'VendorController::edit/$1');
$routes->put('vendors/(:num)', 'VendorController::update/$1');

// CodeIgniter 4 Resource Routes akan membuat rute CRUD lengkap secara otomatis
$routes->resource('categories', ['controller' => 'CategoryController']);
$routes->resource('products', ['controller' => 'ProductController']);
$routes->resource('vendors', ['controller' => 'VendorController']);

// Tambahkan grup rute ini
$routes->group('outgoing', function($routes) {
    $routes->get('/', 'OutgoingController::index');
    $routes->get('new', 'OutgoingController::new');
    $routes->post('/', 'OutgoingController::create');
});

$routes->get('purchases', 'PurchaseController::index'); 
$routes->get('purchases/new', 'PurchaseController::new'); 
$routes->post('purchases', 'PurchaseController::create'); 
$routes->get('purchases/(:num)', 'PurchaseController::show/$1'); 