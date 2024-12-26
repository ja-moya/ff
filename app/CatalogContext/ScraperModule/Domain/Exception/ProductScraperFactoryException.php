<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Domain\Exception;

use App\SharedContext\SharedModule\Domain\Exception\DomainException;

class ProductScraperFactoryException extends DomainException
{
    public static function noScraperForUrl(string $url): self
    {
        return new self(
            sprintf("No scraper service available for url %s", $url)
        );
    }
}
