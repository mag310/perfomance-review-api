<?php

use DI\Container;
use MongoDB\Client;
use Psr\Container\ContainerInterface;

$container = new Container();

$container->set(Client::class, DI\create(Client::class)
    ->constructor(
        'mongodb://mongo/',
        [
            'username'   => getenv('MONGO_INITDB_ROOT_USERNAME'),
            'password'   => getenv('MONGO_INITDB_ROOT_PASSWORD'),
            'ssl'        => false,
            'authSource' => 'admin',
        ],
        []
    ));

$container->set('db', function (ContainerInterface $container) {
    $db = $container->get(Client::class);
    return $db;
});

return $container;