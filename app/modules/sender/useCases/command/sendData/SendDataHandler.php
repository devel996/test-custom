<?php

declare(strict_types=1);

namespace app\modules\sender\useCases\command\sendData;

use app\modules\sender\domain\sendData\SendDataEntity;
use app\modules\sender\services\sendData\SendDataService;

class SendDataHandler
{
    private SendDataCommand $command;

    public function __construct(SendDataCommand $command)
    {
        $this->command = $command;

        // TODO add validation
    }

    public function getData(): SendDataEntity
    {
        $service = new SendDataService($this->command);

        return $service->getData();
    }
}