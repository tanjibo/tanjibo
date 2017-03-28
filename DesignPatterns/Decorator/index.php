<?php

require 'vendor/autoload.php';

//$client=new \MyRightCapital\Development\DecoratorPattern\Client();
//$client->getResponse();


$request = 10;

$middlewares = [
    CheckForMaintenanceMode::class,
    AddQueuedCookiesToResponse::class,
    StartSession::class,
    ShareErrorsFromSession::class,
    VerifyCsrfToken::class,
];

(new \Pipeline\Pipeline())->send($request)->through($middlewares)->then(dispatchToRouter());