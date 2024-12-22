<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http;

use App\Http\Controllers\Controller;
use App\ProductContext\ProductModel\Domain\Repository\ProductRepositoryInterface;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductId;
use App\ProductContext\ProductModel\Infrastructure\Response\ProductResponse;
use Illuminate\Http\JsonResponse;

class ProductGetController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(string $id): JsonResponse
    {
        $product = $this->productRepository->findById(
            new ProductId($id)
        );

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 400);
        }

        return response()->json(ProductResponse::fromProduct($product));
    }
}
