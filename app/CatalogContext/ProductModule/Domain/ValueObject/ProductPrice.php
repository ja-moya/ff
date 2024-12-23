<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Domain\ValueObject;

use App\SharedContext\SharedModule\Domain\Entity\AbstractSimpleValueObject;

/**
 * @extends AbstractSimpleValueObject<float>
 */
class ProductPrice extends AbstractSimpleValueObject
{
    protected function doValidate(): void
    {
    }
}
