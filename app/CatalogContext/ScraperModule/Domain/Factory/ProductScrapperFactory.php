<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Domain\Factory;

use App\CatalogContext\ScraperModule\Domain\Exception\ProductScraperFactoryException;
use App\CatalogContext\ScraperModule\Domain\Service\ScraperServiceInterface;

class ProductScrapperFactory
{
    private iterable $scrapers;

    public function __construct(iterable $scrapers)
    {
        $this->scrapers = $scrapers;
    }

    /**
     * @throws ProductScraperFactoryException
     */
    public function getScraper(string $url): ScraperServiceInterface
    {
        foreach ($this->scrapers as $scraper) {
            if ($scraper->supports($url)) {
                return $scraper;
            }
        }

        throw ProductScraperFactoryException::noScraperForUrl($url);
    }
}
