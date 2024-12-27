<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Application\Command;

use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductImageUrl;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductName;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductPrice;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductUrl;

readonly class CreateProductCommandHandler
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    public function handle(CreateProductCommand $command): void
    {
        $product = new Product(
            new ProductId($command->id),
            new ProductName($command->name),
            new ProductPrice($command->price),
            new ProductImageUrl($command->imageUrl),
            new ProductUrl($command->url)
        );

        $this->productRepository->create($product);
    }
}
