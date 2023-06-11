<?php

declare(strict_types=1);

namespace app\modules\sender\services\sendData;

use app\modules\sender\domain\sendData\SendDataEntity;
use app\modules\sender\domain\sendData\SendDataRepository;
use app\modules\sender\useCases\command\sendData\SendDataCommand;

class SendDataService
{
    private SendDataCommand $command;
    private SendDataRepository $repository;

    public function __construct(SendDataCommand $command)
    {
        $this->command = $command;
        $this->repository = new SendDataRepository();
    }

    public function getData(): SendDataEntity
    {
        return $this->repository->addData($this->command->getData());
    }
}