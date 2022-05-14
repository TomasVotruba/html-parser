<?php

declare(strict_types=1);

namespace HtmlParser\AST;

use HtmlParser\ValueObject\HtmlNode;
use DOMAttr;
use DOMDocument;
use DOMElement;
use DOMNamedNodeMap;
use DOMNode;
use Nette\Utils\FileSystem;
use Nette\Utils\Strings;

final class HTMLNodeFactory
{
    /**
     * @return HtmlNode[]
     */
    public function createFromFilePath(string $filePath): array
    {
        $fileContents = FileSystem::read($filePath);
        if ($fileContents === '') {
            return [];
        }

        $domDocument = new DOMDocument();
        $domDocument->loadHTML($fileContents);

        return $this->createFromDOMNode($domDocument);
    }

    /**
     * @return HtmlNode[]
     */
    private function createFromDOMNode(DOMNode $domNode): array
    {
        $htmlNodes = [];

        foreach ($domNode->childNodes as $childNode) {
            if (! $childNode instanceof DOMElement) {
                continue;
            }

            /** @var DOMElement $childNode */
            $nodeName = $childNode->nodeName;

            $attributes = $this->createAttributes($childNode);

            $childHtmlNodes = $this->createFromDOMNode($childNode);

            $htmlNodes[] = new HtmlNode($nodeName, $attributes, $childHtmlNodes);
        }

        return $htmlNodes;
    }

    /**
     * @return array<string, mixed>
     */
    private function createAttributes(DOMElement $domElement): array
    {
        $attributesMap = $domElement->attributes;
        if (! $attributesMap instanceof DOMNamedNodeMap) {
            return [];
        }

        $attributes = [];

        /** @var array<string, DOMAttr> $items */
        $items = \iterator_to_array($attributesMap->getIterator());

        foreach ($items as $attributeName => $item) {
            $attributes[$attributeName] = $item->value;
        }

        return $attributes;
    }
}
