<?php

declare(strict_types=1);

namespace app\modules\sender\senders;

use app\modules\sender\domain\sendData\SendDataEntity;

interface DataSenderInterface
{
    public function send(SendDataEntity $entity);
}