<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Domain\ValueObject;

use App\ProductContext\ProductModel\Domain\Exception\ProductUrlException;
use App\SharedContext\SharedModule\Domain\Entity\AbstractSimpleValueObject;

/**
 * @extends AbstractSimpleValueObject<string>
 */
class ProductUrl extends AbstractSimpleValueObject
{
    /**
     * @throws ProductUrlException
     */
    protected function doValidate(): void
    {
        if (empty($this->value())) {
            throw ProductUrlException::isEmpty();
        }
    }
}
