<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Domain\Helper;

use App\CatalogContext\ScraperModule\Domain\Exception\DOMDocumentException;
use DOMElement;

class DOMDocumentHelper
{
    /** @return DOMElement[] */
    public static function getAllElementByTagAndClass(string $tag, string $class, DOMElement $domElement): array
    {
        $elements = $domElement->getElementsByTagName($tag);

        $ret = [];
        foreach ($elements as $element) {
            $elementClasses = explode(' ', $element->getAttribute('class'));

            if (in_array($class, $elementClasses, true)) {
                $ret[] = $element;
            }
        }

        return $ret;
    }

    public static function searchFirstElementByTagAndClass(
        string $tag,
        string $class,
        DOMElement $domElement
    ): ?DOMElement {
        $elements = $domElement->getElementsByTagName($tag);

        foreach ($elements as $element) {
            $elementClasses = explode(' ', $element->getAttribute('class'));

            if (in_array($class, $elementClasses, true)) {
                return $element;
            }
        }

        return null;
    }

    /**
     * @throws DOMDocumentException
     */
    public static function findFirstElementByTagAndClass(string $tag, string $class, DOMElement $domElement): DOMElement
    {
        $element = self::searchFirstElementByTagAndClass($tag, $class, $domElement);

        if ($element !== null) {
            return $element;
        }

        throw DOMDocumentException::elementNotFoundByTagAndClass($tag, $class);
    }
}
