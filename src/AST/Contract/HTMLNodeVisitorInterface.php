<?php

declare(strict_types=1);

namespace HtmlParser\AST\Contract;

use HtmlParser\ValueObject\HtmlNode;

interface HTMLNodeVisitorInterface
{
    public function getNodeName(): string;

    public function enterNode(HtmlNode $htmlNode, string $filePath): void;
}
