<?php

declare(strict_types=1);

namespace app\modules\sender\services\index;

use app\application\Csrf;
use app\modules\sender\domain\sendData\SendDataRepository;
use app\modules\sender\useCases\query\index\IndexQuery;

class IndexService
{
    private IndexQuery $query;
    private SendDataRepository $repository;

    public function __construct(IndexQuery $query)
    {
        $this->query = $query;
        $this->repository = new SendDataRepository();
    }

    public function getData(): array
    {
        return [
            'data' => $this->repository->getSendDataList(
                $this->query->getOffset(),
                $this->query->getLimit()
            ),
            'limit' => $this->query->getLimit(),
            'offset' => $this->query->getOffset(),
            'csrf' => Csrf::generateToken()
        ];
    }
}