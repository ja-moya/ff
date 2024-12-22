<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Domain\Exception;

use App\SharedContext\SharedModule\Domain\Exception\DomainException;

class ProductNameException extends DomainException
{
    public static function isEmpty(): self
    {
        return new self("Product name can not be empty");
    }
}