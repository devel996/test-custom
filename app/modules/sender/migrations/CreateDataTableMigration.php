<?php

declare(strict_types=1);

namespace app\modules\sender\migrations;

use app\application\database\Db;
use app\application\interfaces\MigrationInterface;
use app\modules\sender\domain\sendData\SendDataEntity;

class CreateDataTableMigration implements MigrationInterface
{
    public function migrate(): void
    {
        Db::getInstance()->createTable(
            SendDataEntity::getTableName(),
            [
                'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'data' => 'TEXT',
                'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            ]
        );

    }
}

return new CreateDataTableMigration();