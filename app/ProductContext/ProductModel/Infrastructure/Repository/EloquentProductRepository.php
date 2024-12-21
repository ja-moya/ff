<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Infrastructure\Repository;

use App\ProductContext\ProductModel\Domain\Entity\Product;
use App\ProductContext\ProductModel\Domain\Repository\ProductRepositoryInterface;
use App\ProductContext\ProductModel\Infrastructure\Model\ProductEloquentModel;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        // Crear o actualizar el producto usando Eloquent
        ProductEloquentModel::updateOrCreate(
            ['id' => $product->id()],
            [
                'name' => $product->name(),
                'price' => $product->price(),
                'image_url' => $product->imageUrl(),
                'product_url' => $product->productUrl(),
            ]
        );
    }

    public function findById(string $id): ?Product
    {
        $eloquentProduct = ProductEloquentModel::find($id);

        if (!$eloquentProduct) {
            return null;
        }

        return new Product(
            $eloquentProduct->id,
            $eloquentProduct->name,
            $eloquentProduct->price,
            $eloquentProduct->image_url,
            $eloquentProduct->product_url
        );
    }
}
