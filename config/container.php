<?php

use app\interfaces\UserRepositoryInterface;
use app\repositories\UserRepository;
use DI\Container;
use function DI\create;
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
    return $container->get(Client::class);
});

$container->set(UserRepositoryInterface::class, DI\create(UserRepository::class)->constructor($container));
$container->set('userRepository', function (ContainerInterface $container) {
    return $container->get(UserRepositoryInterface::class);
});

return $container;