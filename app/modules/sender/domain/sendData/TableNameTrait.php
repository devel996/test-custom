<?php

declare(strict_types=1);

namespace app\modules\sender\domain\sendData;

trait TableNameTrait
{
    public static function getTableName(): string
    {
        return 'send_data';
    }
}