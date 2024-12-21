<?php

use App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/api/product/{id}',
    [ProductController::class, 'get']
);

Route::get('/api/product',
    [ProductController::class, 'list']
);

Route::post('/api/product',
    [ProductController::class, 'store']
);
