<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Application\Query;

/** @see GetProductQueryHandler */
readonly class GetProductQuery
{
    public function __construct(
        public string $id
    ) {
    }
}
