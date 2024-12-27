<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Application\Command;

/** @see UpdateProductCommandHandler */
readonly class UpdateProductCommand
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
