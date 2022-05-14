<?php

declare(strict_types=1);

namespace HtmlParser\AST;

use HtmlParser\AST\Contract\HTMLNodeVisitorInterface;
use HtmlParser\ValueObject\HtmlNode;

final class HTMLNodeTraverser
{
    /**
     * @param HTMLNodeVisitorInterface[] $htmlNodeVisitors
     */
    public function __construct(
        private array $htmlNodeVisitors
    ) {
    }

    /**
     * @param HtmlNode[] $htmlNodes
     */
    public function traverse(array $htmlNodes, string $filePath): void
    {
        foreach ($htmlNodes as $htmlNode) {
            foreach ($this->htmlNodeVisitors as $htmlNodeVisitor) {
                $htmlNodeVisitor->enterNode($htmlNode, $filePath);
            }

            $this->traverse($htmlNode->getChildren(), $filePath);
        }
    }
}
