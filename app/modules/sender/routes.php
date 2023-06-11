<?php

declare(strict_types=1);

use app\application\routes\RouteValueObject;
use app\application\enums\HttpMethod;
use app\modules\sender\controllers\SenderController;

return [
    new RouteValueObject(
        method: HttpMethod::GET->value,
        route:  '/',
        controller:  SenderController::class,
        action:  'index'
    ),
    new RouteValueObject(
        method: HttpMethod::POST->value,
        route:  '/send-data',
        controller:  SenderController::class,
        action:  'send'
    )
];