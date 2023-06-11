<?php

declare(strict_types=1);

namespace app\modules\sender\senders\phone;

use app\application\Env;
use app\modules\sender\domain\sendData\SendDataEntity;
use app\modules\sender\senders\DataSenderInterface;

class PhoneSenderStrategy implements DataSenderInterface
{
    public function send(SendDataEntity $entity)
    {
        // TODO: Implement send() method.
        $phoneToSend = Env::get('PHONE_TO_SEND');
    }
}