<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Domain\Service;

use App\CatalogContext\ProductModule\Domain\Entity\Product;

interface ScraperServiceInterface
{
    public function supports(string $pageUrl): bool;

    /** @return Product[] */
    public function getPageProducts(string $pageUrl): array;
}
