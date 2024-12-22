<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Domain\ValueObject;

use App\ProductContext\ProductModel\Domain\Exception\ProductImageUrlException;
use App\SharedContext\SharedModule\Domain\Entity\AbstractSimpleValueObject;

/**
 * @extends AbstractSimpleValueObject<string>
 */
class ProductImageUrl extends AbstractSimpleValueObject
{
    /**
     * @throws ProductImageUrlException
     */
    protected function doValidate(): void
    {
        if (empty($this->value())) {
            throw ProductImageUrlException::isEmpty();
        }
    }
}
