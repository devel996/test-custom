<?php

declare(strict_types=1);

namespace app\modules\sender\controllers;

use app\application\Csrf;
use app\application\CsrfTrait;
use app\application\enums\HttpCode;
use app\application\Request;
use app\application\View;
use app\modules\sender\events\sendData\SendDataEvent;
use app\modules\sender\useCases\command\sendData\SendDataCommand;
use app\modules\sender\useCases\command\sendData\SendDataHandler;
use app\modules\sender\useCases\Query\index\IndexHandler;
use app\modules\sender\useCases\query\index\IndexQuery;

class SenderController
{
    use CsrfTrait;

    public function send(): void
    {
        $this->validateCsrf();

        $command = new SendDataCommand();

        $command->setData(Request::post('data'));

        $data = (new SendDataHandler($command))->getData();

        if ($data) {
            (new SendDataEvent($data))->execute();

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function index(): View
    {
        $query = new IndexQuery();

        $query->setLimit((int)Request::get('limit'));
        $query->setOffset((int)Request::get('offset'));

        $data = (new IndexHandler($query))->getData();

        return new View(
            HttpCode::OK->value,
            'sender/views/index/index.php',
            $data
        );
    }
}