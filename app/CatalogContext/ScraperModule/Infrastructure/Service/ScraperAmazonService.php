<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Infrastructure\Service;

use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductImageUrl;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductName;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductPrice;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductUrl;
use App\CatalogContext\ScraperModule\Domain\Service\ScraperServiceInterface;
use Ramsey\Uuid\Uuid;

class ScraperAmazonService implements ScraperServiceInterface
{
    private const BASE_URL = 'https://www.amazon.es/';

    public function supports(string $pageUrl): bool
    {
        return str_contains($pageUrl, self::BASE_URL);
    }

    public function getPageProducts(string $pageUrl): array
    {
        return [
            new Product(
                new ProductId(Uuid::uuid4()->toString()),
                new ProductName('Amazon product 1'),
                new ProductPrice(10.0),
                new ProductImageUrl('https://via.placeholder.com/150'),
                new ProductUrl('https://www.amazon.es/echo-pop/dp/B09WX9XBKD/')
            ),
        ];
    }
}
