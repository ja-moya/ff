<?php

namespace App\Providers;

use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\CatalogContext\ProductModule\Infrastructure\Repository\ProductEloquentRepository;
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
