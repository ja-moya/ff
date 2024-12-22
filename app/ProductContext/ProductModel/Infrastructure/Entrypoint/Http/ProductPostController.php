<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http;

use App\Http\Controllers\Controller;
use App\ProductContext\ProductModel\Domain\Entity\Product;
use App\ProductContext\ProductModel\Domain\Repository\ProductRepositoryInterface;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductId;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductImageUrl;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductName;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductPrice;
use App\ProductContext\ProductModel\Domain\ValueObject\ProductUrl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductPostController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'id' => 'required|uuid',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'imageUrl' => 'required|string',
                'url' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 400);
        }

        $product = new Product(
            new ProductId($validated['id']),
            new ProductName($validated['name']),
            new ProductPrice($validated['price']),
            new ProductImageUrl($validated['imageUrl']),
            new ProductUrl($validated['url'])
        );

        $this->productRepository->save($product);

        return response()->json(['message' => 'Product saved successfully'], 200);
    }

}
