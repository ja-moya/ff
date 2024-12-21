<?php

declare(strict_types=1);

namespace App\ProductContext\ProductModel\Infrastructure\Entrypoint\Http;

use App\Http\Controllers\Controller;
use App\ProductContext\ProductModel\Domain\Entity\Product;
use App\ProductContext\ProductModel\Domain\Repository\ProductRepositoryInterface;
use App\ProductContext\ProductModel\Infrastructure\Model\ProductEloquentModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|uuid',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'imageUrl' => 'required|string',
            'productUrl' => 'required|string',
        ]);

        $product = new Product(
            $validated['id'],
            $validated['name'],
            $validated['price'],
            $validated['imageUrl'],
            $validated['productUrl']
        );

        // Guardar el producto
        $this->productRepository->save($product);

        return response()->json(['message' => 'Product saved successfully'], 200);
    }

    public function list(): array
    {
        return ProductEloquentModel::all()->toArray();
    }

    public function get(string $id): JsonResponse
    {
        $product = $this->productRepository->findById($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json([
            'id' => $product->id(),
            'name' => $product->name(),
            'price' => $product->price(),
            'image_url' => $product->imageUrl(),
            'product_url' => $product->productUrl(),
        ]);
    }
}
