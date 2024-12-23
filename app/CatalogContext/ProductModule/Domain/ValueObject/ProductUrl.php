<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Domain\ValueObject;

use App\CatalogContext\ProductModule\Domain\Exception\ProductUrlException;
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
