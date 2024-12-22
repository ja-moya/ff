<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Domain\Repository;

use App\ProductContext\ProductModel\Domain\Entity\Product;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductId;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;

    public function findById(ProductId $id): ?Product;

    /** @return Product[] */
    public function list(): array;
}
