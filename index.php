<?php

use app\middleware\BearerAuthMiddleware;
use app\middleware\UnauthorizedMiddleware;
use app\modules\main\DefaultController;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$container = include __DIR__ . '/config/container.php';

$app = AppFactory::createFromContainer($container);
$app->addRoutingMiddleware();

$httpUnauthorizedExceptionHandler = new HttpUnauthorizedException($app->getCallableResolver(), $app->getResponseFactory());

$app->addErrorMiddleware(true, true, true)
    ->setErrorHandler(HttpUnauthorizedException::class, $httpUnauthorizedExceptionHandler);

$app->addBodyParsingMiddleware();

$app->addMiddleware(new UnauthorizedMiddleware($container))
    ->addMiddleware(new BearerAuthMiddleware($container));

$app->get('/', [DefaultController::class, 'home']);

$app->run();