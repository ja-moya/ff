<?php

declare(strict_types=1);

namespace App\SharedContext\SharedModule\Domain\Entity;

/**
 * @template T
 */
abstract class AbstractSimpleValueObject extends AbstractValueObject
{
    protected $value;

    /**
     * @param T $value
     */
    public function __construct($value)
    {
        $this->value = $value;
        parent::__construct();
    }

    /**
     * @return T
     */
    public function value()
    {
        return $this->value;
    }

    public function equals(self $valueObject): bool
    {
        return $valueObject->value() === $this->value;
    }
}
