<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Application\Query;

use App\CatalogContext\ProductModule\Application\Response\ProductResponse;
use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;

readonly class ListProductQueryHandler
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function handle(ListProductQuery $query): array
    {
        /** @todo $query unused because lack of criteria for filtering */
        $products = $this->productRepository->list();

        return array_map(
            static function (Product $product) {
                return ProductResponse::fromProduct($product);
            },
            $products
        );
    }
}
