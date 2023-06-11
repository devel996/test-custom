<?php

declare(strict_types=1);

namespace app\modules\sender\events\sendData;

use app\application\enums\SenderType;
use app\application\Env;
use app\application\exceptions\ConfigException;
use app\modules\sender\domain\sendData\SendDataEntity;
use app\modules\sender\senders\DataSenderInterface;
use app\modules\sender\senders\email\EmailSenderStrategy;
use app\modules\sender\senders\phone\PhoneSenderStrategy;

class SendDataEvent
{
    private SendDataEntity $entity;

    public function __construct(SendDataEntity $entity)
    {
        $this->entity = $entity;
    }

    public function execute(): void
    {
        // TODO add in queue, ant after that send notifications to email and phone
        $this->getSender()->send($this->entity);
    }

    private function getSender(): DataSenderInterface
    {
        $senderType = Env::get('SENDER');

        if ($senderType === null ||
            !in_array(
                $senderType,
                array_column(SenderType::cases(), 'value')
            )) {
            throw new ConfigException('Invalid sender');
        }

        return [
            SenderType::EMAIL->value => new EmailSenderStrategy(),
            SenderType::PHONE->value => new PhoneSenderStrategy(),
        ][$senderType];
    }
}