<?php

use App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http\ProductListController;
use App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http\ProductGetController;
use App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http\ProductPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/api/product/{id}',
    [ProductGetController::class, '__invoke']
);

Route::get('/api/product',
    [ProductListController::class, '__invoke']
);

Route::post('/api/product',
    [ProductPostController::class, '__invoke']
);
