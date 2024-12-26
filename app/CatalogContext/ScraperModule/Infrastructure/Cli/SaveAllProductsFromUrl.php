<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Infrastructure\Cli;

use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\CatalogContext\ScraperModule\Domain\Factory\ProductScrapperFactory;
use App\CatalogContext\ScraperModule\Domain\Service\ProductScraperService;
use App\CatalogContext\ScraperModule\Infrastructure\Service\ScraperAmazonService;
use App\CatalogContext\ScraperModule\Infrastructure\Service\ScraperCarrefourService;
use Illuminate\Console\Command;

class SaveAllProductsFromUrl extends Command
{
    protected $signature = 'product:save-all-from-url {url}';
    protected $description = 'Guardar productos desde la URL proporcionada';

    private ProductScraperService $productScraperService;
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        parent::__construct();
        $productScraperFactory = new ProductScrapperFactory(
            [
                new ScraperCarrefourService(),
                new ScraperAmazonService(),
            ]
        );
        $this->productScraperService = new ProductScraperService($productScraperFactory);
        $this->productRepository = $productRepository;
    }

    public function handle($url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            echo 'La URL proporcionada no es válida.' . PHP_EOL;
            return;
        }

        $products = $this->productScraperService->getProducts($url);

        foreach ($products as $product) {
            $this->productRepository->save($product);
        }
    }
}
