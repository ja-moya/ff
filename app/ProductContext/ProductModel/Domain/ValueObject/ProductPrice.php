<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Domain\ValueObject;

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
