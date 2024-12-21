<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Domain\Entity;

class Product
{
    private string $id;
    private string $name;
    private float $price;
    private string $imageUrl;
    private string $productUrl;

    public function __construct(string $id, string $name, float $price, string $imageUrl, string $productUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->productUrl = $productUrl;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function imageUrl(): string
    {
        return $this->imageUrl;
    }

    public function productUrl(): string
    {
        return $this->productUrl;
    }
}
