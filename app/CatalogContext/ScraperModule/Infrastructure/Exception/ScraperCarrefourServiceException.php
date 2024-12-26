<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Infrastructure\Exception;

use App\SharedContext\SharedModule\Domain\Exception\DomainException;

class ScraperCarrefourServiceException extends DomainException
{
    public static function productListNotFound(string $pageUrl): self
    {
        return new self('Product list not found for page ' . $pageUrl);
    }
}
