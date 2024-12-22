<?php

declare(strict_types=1);

namespace App\SharedContext\SharedModule\Domain\Exception;

class AbstractUuidException extends DomainException
{
    public static function fromValue(string $value): self
    {
        return new self(
            sprintf(
                "%s is not a valid uuid value",
                $value
            )
        );
    }
}
