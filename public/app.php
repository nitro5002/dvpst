<?php

require __DIR__ . "/../config/Bootstrap.php";

use \Logger\Logger;

$logApi = new Logger('api');
$logDvpst = new Logger('dvpst');

$app = new \Slim\App(array(
    'debug' => DEBUG,
    'mode' => ENVIRONMENT
));

$app->get('/users', \Api\Actions\Users::class);