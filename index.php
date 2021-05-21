<?php

use app\handlers\HttpUnauthorizedExceptionHandler;
use app\middleware\BearerAuthMiddleware;
use app\middleware\UnauthorizedMiddleware;
use app\modules\main\DefaultController;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$container = include __DIR__ . '/config/container.php';

$app = AppFactory::createFromContainer($container);
$app->addRoutingMiddleware();

$app->addBodyParsingMiddleware();

$app->addMiddleware(new UnauthorizedMiddleware($container))
    ->addMiddleware(new BearerAuthMiddleware($container));

$app->addErrorMiddleware(true, true, true)
    ->setErrorHandler(
        HttpUnauthorizedException::class,
        new HttpUnauthorizedExceptionHandler($app->getCallableResolver(), $app->getResponseFactory())
    );

$app->get('/', [DefaultController::class, 'home']);

$app->run();