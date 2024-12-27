<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Infrastructure\Service;

use App\CatalogContext\ProductModule\Domain\Entity\Product;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductId;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductImageUrl;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductName;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductPrice;
use App\CatalogContext\ProductModule\Domain\ValueObject\ProductUrl;
use App\CatalogContext\ScraperModule\Domain\Exception\DOMDocumentException;
use App\CatalogContext\ScraperModule\Domain\Helper\DOMDocumentHelper;
use App\CatalogContext\ScraperModule\Domain\Service\BrowserShotPageLoaderService;
use App\CatalogContext\ScraperModule\Domain\Service\ScraperServiceInterface;
use App\CatalogContext\ScraperModule\Infrastructure\Exception\ScraperCarrefourServiceException;
use DOMDocument;
use DOMElement;
use Ramsey\Uuid\Uuid;

class ScraperCarrefourService implements ScraperServiceInterface
{
    private const BASE_URL = 'https://www.carrefour.es';
    private const COOKIES = [
        ['name' => 'cookie_name', 'value' => 'cookie_value', 'domain' => 'www.carrefour.es'],
        [
            'name' => 'salepoint',
            'value' => '005212|4700003|DRIVE|0',
            'path' => '/',
            'domain' => 'www.carrefour.es'
        ] // Example of a cookie may be used in the service
    ];

    private BrowserShotPageLoaderService $browserShotPageLoaderService;

    public function __construct()
    {
        $this->browserShotPageLoaderService = new BrowserShotPageLoaderService();
    }

    public function supports(string $pageUrl): bool
    {
        return str_contains($pageUrl, self::BASE_URL);
    }

    /**
     * @return Product[]
     * @throws ScraperCarrefourServiceException
     * @throws DOMDocumentException
     */
    public function getPageProducts(string $pageUrl): array
    {
        $domDocument = $this->browserShotPageLoaderService->__invoke($pageUrl, self::COOKIES);
        $listElement = $this->findListElement($domDocument, $pageUrl);
        return $this->getProductsFromListElement($listElement);
    }

    /**
     * @throws ScraperCarrefourServiceException
     */
    private function findListElement(DOMDocument $domDocument, string $pageUrl): DOMElement
    {
        $listElements = $domDocument->getElementsByTagName('ul');

        foreach ($listElements as $listElement) {
            if ($listElement->getAttribute('class') === 'product-card-list__list') {
                return $listElement;
            }
        }

        throw ScraperCarrefourServiceException::productListNotFound($pageUrl);
    }

    /**
     * @return Product[]
     * @throws DOMDocumentException
     */
    private function getProductsFromListElement(DOMElement $listElement): array
    {
        $itemElements = DOMDocumentHelper::getAllElementByTagAndClass('li', 'product-card-list__item', $listElement);

        $products = [];
        foreach ($itemElements as $itemElement) {
            $product = $this->getProductFromItemElement($itemElement);
            if ($product !== null) {
                $products[] = $product;
            }
        }

        return $products;
    }

    /**
     * @throws DOMDocumentException
     */
    private function getProductFromItemElement(DOMElement $itemElement): ?Product
    {
        $nameElement = DOMDocumentHelper::searchFirstElementByTagAndClass('a', 'product-card__title-link', $itemElement);

        if ($nameElement === null) {
            return null;
        }

        $name = $nameElement->nodeValue;
        $name = str_replace(array("\n", "\r"), '', trim($name));

        $price = DOMDocumentHelper::findFirstElementByTagAndClass('span', 'product-card__price', $itemElement)
            ->nodeValue;
        $price = str_replace(array("\n", "\r"), '', trim($price));
        $price = (float)str_replace(',', '.', preg_replace('/\D/', '', $price));

        $imageUrl = DOMDocumentHelper::findFirstElementByTagAndClass('img', 'product-card__image', $itemElement)
            ->getAttribute('src');

        $url = DOMDocumentHelper::findFirstElementByTagAndClass('a', 'product-card__title-link', $itemElement)
            ->getAttribute('href');

        return new Product(
            new ProductId(Uuid::uuid4()->toString()),
            new ProductName($name),
            new ProductPrice($price),
            new ProductImageUrl($imageUrl),
            new ProductUrl($url)
        );
    }
}
