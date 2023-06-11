<?php

declare(strict_types=1);

namespace app\modules\sender\useCases\query\index;


use app\modules\sender\services\index\IndexService;

class IndexHandler
{
    private IndexQuery $query;

    public function __construct(IndexQuery $query)
    {
        $this->query = $query;

        // TODO add validation
    }

    public function getData(): array
    {
        $service = new IndexService($this->query);

        return $service->getData();
    }
}