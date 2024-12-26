<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Domain\ValueObject;

use App\CatalogContext\ProductModule\Domain\Exception\ProductNameException;
use App\SharedContext\SharedModule\Domain\Entity\AbstractSimpleValueObject;

/**
 * @extends AbstractSimpleValueObject<string>
 */
class ProductName extends AbstractSimpleValueObject
{
    /**
     * @throws ProductNameException
     */
    protected function doValidate(): void
    {
        if (empty($this->value())) {
            throw ProductNameException::isEmpty();
        }
    }
}
