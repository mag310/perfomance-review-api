<?php

use app\exceptions\NoValidationException;
use app\handlers\HttpUnauthorizedExceptionHandler;
use app\handlers\NoValidateExceptionHandle;
use app\middleware\BearerAuthMiddleware;
use app\middleware\UnauthorizedMiddleware;
use app\modules\auth\AuthController;
use app\modules\user\DefaultController;
use app\modules\comment\controllers\CommentController;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';

$container = include __DIR__ . '/config/container.php';

$app = AppFactory::createFromContainer($container);
$app->addRoutingMiddleware();

$app->addBodyParsingMiddleware();

$app->addMiddleware(new BearerAuthMiddleware($container));

$app->addErrorMiddleware(true, true, true)
    ->setErrorHandler(
        HttpUnauthorizedException::class,
        new HttpUnauthorizedExceptionHandler($app->getCallableResolver(), $app->getResponseFactory())
    )->setErrorHandler(
        NoValidationException::class,
        new NoValidateExceptionHandle($app->getCallableResolver(), $app->getResponseFactory())
    );

$app->group('/auth', function (RouteCollectorProxy $group) {
    $group->post('/login', [AuthController::class, 'login']);
    $group->get('/logout', [AuthController::class, 'logout']);
});

$app->group('/user', function (RouteCollectorProxy $group) {
    $group->get('', [DefaultController::class, 'info']);
    $group->get('/info/{id}', [DefaultController::class, 'info']);
    $group->put('', [DefaultController::class, 'update']);
})->addMiddleware(new UnauthorizedMiddleware($container));;

$app->group('/comment', function (RouteCollectorProxy $group) {
    $group->post('', [CommentController::class, 'add']);
    $group->put('/{id}', [CommentController::class, 'edit']);
})->addMiddleware(new UnauthorizedMiddleware($container));

$app->run();