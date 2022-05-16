<?php

declare(strict_types=1);

namespace HtmlParser\AST\ValueObject;

final class HtmlNode
{
    public function __construct(
        private string $name,
        private array $attributes,
        private array $children
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return HtmlNode[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }
}
