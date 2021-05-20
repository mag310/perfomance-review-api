<?php

use app\middleware\BearerAuthMiddleware;
use app\modules\main\DefaultController;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
$container = include __DIR__ . '/config/container.php';

$app = AppFactory::createFromContainer($container);
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->addBodyParsingMiddleware();

$app->addMiddleware(new BearerAuthMiddleware($app));
$app->get('/', [DefaultController::class, 'home']);

$app->run();