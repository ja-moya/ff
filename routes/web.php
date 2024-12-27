<?php

use App\CatalogContext\ProductModule\Infrastructure\Entrypoint\Http\ProductGetController;
use App\CatalogContext\ProductModule\Infrastructure\Entrypoint\Http\ProductListController;
use App\CatalogContext\ProductModule\Infrastructure\Entrypoint\Http\ProductPostController;
use App\CatalogContext\ProductModule\Infrastructure\Entrypoint\Http\ProductPutController;
use App\SharedContext\SharedModule\Infrastructure\Entrypoint\Http\SandboxController;
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

Route::put('/api/product',
    [ProductPutController::class, '__invoke']
);

Route::post('/api/sandbox',
    [SandboxController::class, '__invoke']
);
