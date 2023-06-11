<?php

declare(strict_types=1);

namespace app\modules\sender\useCases\query\index;

class IndexQuery
{
    private int $limit = 10;
    private int $offset = 0;

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }
}