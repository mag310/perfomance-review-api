<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$database = new MongoDB\Client('mongodb://mongo/', [
    'username'   => 'root',
    'password'   => 'example',
    'ssl'        => false,
    'authSource' => 'admin',
]);
$res = $database->perfomance->perfomance->insertOne(
    [
        'username' => 'admin',
        'email'    => 'admin@example.com',
        'name'     => 'Admin User',
    ]);
var_dump($res);
//
//$app = AppFactory::create();
//
//// Добавление промежуточного ПО обработки ошибок
//$app->addErrorMiddleware(true, false, false);
//
//$app->get('/', function (Request $request, Response $response, $args) {
//    $response->getBody()->write("Hello world!");
//    return $response;
//});
//
//$app->run();