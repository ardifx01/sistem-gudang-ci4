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

// CodeIgniter 4 Resource Routes akan membuat rute CRUD lengkap secara otomatis
$routes->resource('categories', ['controller' => 'CategoryController']);