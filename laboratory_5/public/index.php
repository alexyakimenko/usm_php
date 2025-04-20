<?php

require_once sprintf("%s/../vendor/autoload.php", __DIR__);

use App\Core\Application;

$app = new Application();

$app->run();