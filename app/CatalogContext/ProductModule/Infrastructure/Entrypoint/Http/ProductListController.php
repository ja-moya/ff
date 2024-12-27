<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Infrastructure\Entrypoint\Http;

use App\CatalogContext\ProductModule\Application\Query\ListProductQuery;
use App\CatalogContext\ProductModule\Application\Query\ListProductQueryHandler;
use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProductListController extends Controller
{

    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected ListProductQueryHandler $listProductQueryHandler
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $listProductQuery = new ListProductQuery();
        $productsData = $this->listProductQueryHandler->handle($listProductQuery);

        return response()->json($productsData);
    }
}
