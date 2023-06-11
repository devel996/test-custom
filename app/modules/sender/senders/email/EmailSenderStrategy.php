<?php

declare(strict_types=1);

namespace app\modules\sender\senders\email;

use app\application\Env;
use app\modules\sender\domain\sendData\SendDataEntity;
use app\modules\sender\senders\DataSenderInterface;

class EmailSenderStrategy implements DataSenderInterface
{
    public function send(SendDataEntity $entity)
    {
        // TODO: Implement send() method.
        $emailToSend = Env::get('EMAIL_TO_SEND');
    }
}