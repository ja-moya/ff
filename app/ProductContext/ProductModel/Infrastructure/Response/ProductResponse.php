<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Infrastructure\Response;

use App\ProductContext\ProductModel\Domain\Entity\Product;

class ProductResponse
{
    public static function fromProduct(Product $product): array
    {
        return [
            "id" => $product->id()->value(),
            "name" => $product->name()->value(),
            "price" => $product->price()->value(),
            "imageUrl" => $product->imageUrl()->value(),
            "url" => $product->url()->value(),
        ];
    }
}