<?php

declare(strict_types=1);

namespace App\CatalogContext\ProductModule\Infrastructure\Entrypoint\Http;

use App\CatalogContext\ProductModule\Application\Command\UpdateProductCommand;
use App\CatalogContext\ProductModule\Application\Command\UpdateProductCommandHandler;
use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ProductModule\Domain\Repository\ProductRepositoryInterface;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductImageUrl;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductName;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductPrice;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductUrl;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductPutController extends Controller
{
    private const PRODUCT_ID = 'id';
    private const PRODUCT_NAME = 'name';
    private const PRODUCT_PRICE = 'price';
    private const PRODUCT_IMAGE_URL = 'imageUrl';
    private const PRODUCT_URL = 'url';


    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected UpdateProductCommandHandler $updateProductCommandHandler
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                self::PRODUCT_ID => 'required|uuid|exists:products,id',
                self::PRODUCT_NAME => 'required|string',
                self::PRODUCT_PRICE => 'required|numeric',
                self::PRODUCT_IMAGE_URL => 'required|string',
                self::PRODUCT_URL => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 400);
        }

        $updateProductCommand = new UpdateProductCommand(
            $validated[self::PRODUCT_ID],
            $validated[self::PRODUCT_NAME],
            $validated[self::PRODUCT_PRICE],
            $validated[self::PRODUCT_IMAGE_URL],
            $validated[self::PRODUCT_URL]
        );

        $this->updateProductCommandHandler->handle($updateProductCommand);

        return response()->json(['message' => 'Product updated successfully'], 200);
    }
}
