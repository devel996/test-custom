<?php

use app\modules\sender\domain\sendData\SendDataEntity;

/** @var SendDataEntity[] $data */
$data = $params['data'] ?? [];
$limit = $params['limit'] ?? 10;
$offset = $params['offset'] ?? 0;
$csrf = $params['csrf'] ?? '';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Data Example</title>
    <style>
        #inputData {
            width: 300px;
            height: 200px;
            resize: none;
        }

        #outputData {
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Input Data Example</h1>
<form method="post" action="/send-data">
    <textarea name="data" id="inputData" placeholder="Enter your data here"></textarea>
    <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
    <button type="submit">Add Data</button>
</form>
<div id="outputData">
    <?= "Limit $limit, Offset $offset" ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Created At</th>
        </tr>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?= $item->getId(); ?></td>
                <td><?= $item->getData(); ?></td>
                <td><?= $item->getCreatedAt(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
