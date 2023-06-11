<?php

use app\application\Migrate;

require __DIR__ . '/../vendor/autoload.php';

(new Migrate())->run();