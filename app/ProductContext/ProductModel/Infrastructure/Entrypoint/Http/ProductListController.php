<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http;

use App\Http\Controllers\Controller;
use App\ProductContext\ProductModel\Domain\Entity\Product;
use App\ProductContext\ProductModel\Domain\Repository\ProductRepositoryInterface;
use App\ProductContext\ProductModel\Infrastructure\Response\ProductResponse;
use Illuminate\Http\JsonResponse;

class ProductListController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(): JsonResponse
    {
        $products = $this->productRepository->list();

        return response()->json(
            array_map(
                static function (Product $product) {
                    return ProductResponse::fromProduct($product);
                },
                $products
            )
        );
    }
}
