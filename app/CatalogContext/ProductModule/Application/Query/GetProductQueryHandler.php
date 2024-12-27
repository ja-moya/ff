<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Application\Query;

use App\CatalogContext\ProductModule\Application\Response\ProductResponse;
use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;

readonly class GetProductQueryHandler
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function handle(GetProductQuery $query): ?array
    {
        $product = $this->productRepository->findById(
            new ProductId($query->id)
        );

        return $product ? ProductResponse::fromProduct($product) : null;
    }
}
