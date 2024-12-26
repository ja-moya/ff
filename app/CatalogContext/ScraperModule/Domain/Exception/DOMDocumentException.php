<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Domain\Exception;

use App\SharedContext\SharedModule\Domain\Exception\DomainException;

class DOMDocumentException extends DomainException
{
    public static function elementNotFoundByTagAndClass(string $tag, string $class): self
    {
        return new self(
            sprintf("Element not found for tag %s and class %s", $tag, $class)
        );
    }
}
