<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Infrastructure\Cli;

use App\CatalogContext\ProductModule\Infrastructure\Response\ProductResponse;
use App\CatalogContext\ScraperModule\Domain\Factory\ProductScrapperFactory;
use App\CatalogContext\ScraperModule\Domain\Service\ProductScraperService;
use App\CatalogContext\ScraperModule\Infrastructure\Service\ScraperAmazonService;
use App\CatalogContext\ScraperModule\Infrastructure\Service\ScraperCarrefourService;
use Illuminate\Console\Command;

class ShowAllProductsFromUrl extends Command
{
    protected $signature = 'product:show-all-from-url {url}';
    protected $description = 'Mostrar productos desde la URL proporcionada';

    private ProductScraperService $productScraperService;

    public function __construct()
    {
        parent::__construct();
        $productScraperFactory = new ProductScrapperFactory(
            [
                new ScraperCarrefourService(),
                new ScraperAmazonService(),
            ]
        );
        $this->productScraperService = new ProductScraperService($productScraperFactory);
    }

    /**
     * @throws \JsonException
     */
    public function handle($url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            echo 'La URL proporcionada no es válida.' . PHP_EOL;
            return;
        }

        $products = $this->productScraperService->getProducts($url);

        $productsResponse = array_map(
            static fn($product) => ProductResponse::fromProduct($product),
            $products
        );

        echo json_encode($productsResponse,
                JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            . PHP_EOL;
    }
}
