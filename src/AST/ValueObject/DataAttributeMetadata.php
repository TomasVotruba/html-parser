<?php

declare(strict_types=1);

namespace HtmlParser\AST\ValueObject;

final class DataAttributeMetadata
{
    public function __construct(
        private string $attributeName,
        private string $value,
        private string $filePath
    ) {
    }

    public function getAttributeName(): string
    {
        return $this->attributeName;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
