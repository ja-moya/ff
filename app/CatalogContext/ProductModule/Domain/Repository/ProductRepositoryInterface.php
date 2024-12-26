<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Domain\Repository;

use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;

    public function findById(ProductId $id): ?Product;

    /** @return Product[] */
    public function list(): array;
}
