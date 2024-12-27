<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Infrastructure\Entrypoint\Http;

use App\CatalogContext\ProductModule\Application\Query\GetProductQuery;
use App\CatalogContext\ProductModule\Application\Query\GetProductQueryHandler;
use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProductGetController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected GetProductQueryHandler $getProductQueryHandler
    ) {
    }

    public function __invoke(string $id): JsonResponse
    {
        $getProductQuery = new GetProductQuery($id);
        $productData = $this->getProductQueryHandler->handle($getProductQuery);

        if ($productData === null) {
            return response()->json(['message' => 'Product not found'], 400);
        }

        return response()->json($productData);
    }
}
