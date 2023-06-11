<?php

declare(strict_types=1);

namespace app\modules\sender\domain\sendData;

use app\application\database\Db;

class SendDataRepository
{
    public function getSendDataList(int $offset, int $limit): array
    {
        $table = SendDataEntity::getTableName();

        $data = Db::getInstance()->fetchAll(
            "SELECT $table.* FROM $table LIMIT :limit OFFSET :offset",
            [
                ':limit' => $limit,
                ':offset' => $offset
            ]
        );

        if (!is_array($data)) {
            return [];
        }

        return array_map(function (array $item): SendDataEntity {
            $entity = new SendDataEntity();

            $entity->setId($item['id'] ?? 0);
            $entity->setData($item['data'] ?? '');
            $entity->setCreatedAt($item['created_at'] ?? '');

            return $entity;
        }, $data);
    }

    public function addData(string $data): SendDataEntity
    {
        $table = SendDataEntity::getTableName();

        $lastId = Db::getInstance()->insert(
            SendDataEntity::getTableName(),
            [
                'data' => $data
            ]
        );

        $item = Db::getInstance()->fetchOne(
            "SELECT $table.* FROM $table WHERE id=:id",
            [
                "id" => $lastId
            ]
        );

        $entity = new SendDataEntity();

        $entity->setId($item['id'] ?? 0);
        $entity->setData($item['data'] ?? '');
        $entity->setCreatedAt($item['created_at'] ?? '');

        return $entity;
    }
}