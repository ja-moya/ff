<?php

declare(strict_types=1);

namespace App\SharedContext\SharedModule\Domain\Entity;

abstract class AbstractValueObject
{
    public function __construct()
    {
        $this->doValidate();
    }

    abstract protected function doValidate(): void;
}
