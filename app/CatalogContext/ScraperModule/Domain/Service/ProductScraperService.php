<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Domain\Service;

use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ScraperModule\Domain\Exception\ProductScraperFactoryException;
use App\CatalogContext\ScraperModule\Domain\Factory\ProductScrapperFactory;

class ProductScraperService
{
    private ProductScrapperFactory $productScrapperFactory;

    public function __construct(ProductScrapperFactory $productScrapperFactory)
    {
        $this->productScrapperFactory = $productScrapperFactory;
    }

    /**
     * @throws ProductScraperFactoryException
     * @return Product[]
     */
    public function getProducts(string $pageUrl): array
    {
        return $this->productScrapperFactory->getScraper($pageUrl)->getPageProducts($pageUrl);
    }
}
