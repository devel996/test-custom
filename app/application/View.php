<?php

declare(strict_types=1);

namespace app\application;

class View
{
    private int $statusCode;
    private string $file;
    private array $params;

    public function __construct(int $statusCode, string $file, array $params = [])
    {
        $this->statusCode = $statusCode;
        $this->file = $file;
        $this->params = $params;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}