<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Application\Command;

/** @see CreateProductCommandHandler */
readonly class CreateProductCommand
{
    public function __construct(
        public string $id,
        public string $name,
        public float $price,
        public string $imageUrl,
        public string $url
    ) {
    }
}
