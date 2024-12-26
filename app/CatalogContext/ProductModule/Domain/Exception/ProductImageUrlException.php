<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Domain\Exception;

use App\SharedContext\SharedModule\Domain\Exception\DomainException;

class ProductImageUrlException extends DomainException
{
    public static function isEmpty(): self
    {
        return new self("Product image url can not be empty");
    }
}
