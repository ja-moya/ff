<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Domain\Repository;

use App\ProductContext\ProductModel\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;

    public function findById(string $id): ?Product;
}
