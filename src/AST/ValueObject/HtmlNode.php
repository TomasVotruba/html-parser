<?php

declare(strict_types=1);

namespace HtmlParser\AST\ValueObject;

final class HtmlNode
{
    /**
     * @param array<string, mixed> $attributes
     * @param HtmlNode[] $children
     */
    public function __construct(
        private readonly string $name,
        private readonly array $attributes,
        private readonly array $children
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
