<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Infrastructure\Repository;

use App\ProductContext\ProductModel\Domain\Entity\Product;
use App\ProductContext\ProductModel\Domain\Repository\ProductRepositoryInterface;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductId;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductImageUrl;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductName;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductPrice;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductUrl;
use App\ProductContext\ProductModel\Infrastructure\Model\ProductEloquentModel;

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
