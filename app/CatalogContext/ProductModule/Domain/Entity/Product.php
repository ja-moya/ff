<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Domain\Entity;

use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductImageUrl;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductName;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductPrice;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductUrl;

class Product
{
    private ProductId $id;
    private ProductName $name;
    private ProductPrice $price;
    private ProductImageUrl $imageUrl;
    private ProductUrl $url;

    public function __construct(
        ProductId $id,
        ProductName $name,
        ProductPrice $price,
        ProductImageUrl $imageUrl,
        ProductUrl $url
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->url = $url;
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function price(): ProductPrice
    {
        return $this->price;
    }

    public function imageUrl(): ProductImageUrl
    {
        return $this->imageUrl;
    }

    public function url(): ProductUrl
    {
        return $this->url;
    }
}
