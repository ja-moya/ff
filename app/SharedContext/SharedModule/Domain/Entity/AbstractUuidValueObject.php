<?php

declare(strict_types=1);

namespace App\SharedContext\SharedModule\Domain\Entity;

use App\SharedContext\SharedModule\Domain\Exception\AbstractUuidException;
use Ramsey\Uuid\Uuid;

/**
 * @extends AbstractSimpleValueObject<string>
 */
class AbstractUuidValueObject extends AbstractSimpleValueObject
{
    /**
     * @throws AbstractUuidException
     */
    protected function doValidate(): void
    {
        if (!Uuid::isValid($this->value())) {
            throw AbstractUuidException::fromValue($this->value());
        }
    }
}
