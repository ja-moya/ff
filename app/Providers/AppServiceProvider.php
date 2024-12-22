<?php

namespace App\Providers;

use App\ProductContext\ProductModel\Domain\Repository\ProductRepositoryInterface;
use App\ProductContext\ProductModel\Infrastructure\Repository\ProductEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
