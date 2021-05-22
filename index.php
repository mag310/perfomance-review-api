<?php

use app\exceptions\NoValidationException;
use app\handlers\HttpUnauthorizedExceptionHandler;
use app\handlers\NotFoundExceptionHandler;
use app\handlers\NoValidateExceptionHandle;
use app\middleware\BearerAuthMiddleware;
use app\middleware\CORSMiddleware;
use app\middleware\UnauthorizedMiddleware;
use app\modules\auth\AuthController;
use app\modules\chat\MessageController;
use app\modules\user\DefaultController;
use app\modules\comment\controllers\CommentController;
use app\modules\pr\controller\PrController;
use app\modules\user\ListController;
use DI\NotFoundException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';

$container = include __DIR__ . '/config/container.php';

$app = AppFactory::createFromContainer($container);
$app->addRoutingMiddleware();

$app->addBodyParsingMiddleware();

$app->addMiddleware(new BearerAuthMiddleware($container));
$app->addMiddleware(new CORSMiddleware());

$app->addErrorMiddleware(true, true, true)
    ->setErrorHandler(
        HttpUnauthorizedException::class,
        new HttpUnauthorizedExceptionHandler($app->getCallableResolver(), $app->getResponseFactory())
    )->setErrorHandler(
        NoValidationException::class,
        new NoValidateExceptionHandle($app->getCallableResolver(), $app->getResponseFactory())
    )->setErrorHandler(
        NotFoundException::class,
        new NotFoundExceptionHandler($app->getCallableResolver(), $app->getResponseFactory())
    );

$app->group('/auth', function (RouteCollectorProxy $group) {
    $group->post('/login', [AuthController::class, 'login']);
    $group->get('/logout', [AuthController::class, 'logout']);
});

$app->group('/user', function (RouteCollectorProxy $group) {
    $group->get('', [DefaultController::class, 'info']);
    $group->get('/info/{id}', [DefaultController::class, 'info']);
    $group->get('/list', [ListController::class, 'list']);
    $group->put('', [DefaultController::class, 'update']);
})->addMiddleware(new UnauthorizedMiddleware($container));

$app->group('/comment', function (RouteCollectorProxy $group) {
    $group->post('', [CommentController::class, 'save']);
    $group->put('/{id}', [CommentController::class, 'save']);
})->addMiddleware(new UnauthorizedMiddleware($container));

$app->group('/pr', function (RouteCollectorProxy $group) {
    $group->post('', [PrController::class, 'save']);
    $group->put('/{id}', [PrController::class, 'save']);
})->addMiddleware(new UnauthorizedMiddleware($container));

$app->group('/chat', function (RouteCollectorProxy $group) {
    $group->get('/message', [MessageController::class, 'unSending']);
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});
$app->run();