<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Infrastructure\Repository;

use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductImageUrl;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductName;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductPrice;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductUrl;
use App\CatalogContext\ProductModule\Infrastructure\Model\ProductEloquentModel;

class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        ProductEloquentModel::updateOrCreate(
            ['id' => $product->id()->value()],
            [
                'name' => $product->name()->value(),
                'price' => $product->price()->value(),
                'image_url' => $product->imageUrl()->value(),
                'url' => $product->url()->value(),
            ]
        );
    }

    public function findById(ProductId $id): ?Product
    {
        $eloquentProduct = ProductEloquentModel::find($id->value());

        if (!$eloquentProduct) {
            return null;
        }

        return $this->entityFromModel($eloquentProduct);
    }

    public function list(): array
    {
        $all = ProductEloquentModel::all();

        return array_map(
            fn(ProductEloquentModel $productModel) => $this->entityFromModel($productModel),
            $all->all()
        );
    }

    private function entityFromModel(ProductEloquentModel $productModel): Product
    {
        return new Product(
            new ProductId($productModel->id),
            new ProductName($productModel->name),
            new ProductPrice($productModel->price),
            new ProductImageUrl($productModel->image_url),
            new ProductUrl($productModel->url)
        );
    }
}
