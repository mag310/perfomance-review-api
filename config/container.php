<?php

use app\factories\PrFactory;
use app\factories\UserFactory;
use app\interfaces\PrFactoryInterface;
use app\interfaces\UserFactoryInterface;
use app\interfaces\UserRepositoryInterface;
use app\repositories\PrRepository;
use app\interfaces\PrRepositoryInterface;
use app\repositories\UserRepository;
use app\factories\CommentFactory;
use app\interfaces\CommentFactoryInterface;
use app\interfaces\CommentRepositoryInterface;
use app\repositories\CommentRepository;
use DI\Container;
use MongoDB\Client;
use Psr\Container\ContainerInterface;

$container = new Container();

$container->set(Client::class, DI\create(Client::class)
    ->constructor(
        'mongodb://mongo/',
        [
            'username' => getenv('MONGO_INITDB_ROOT_USERNAME'),
            'password' => getenv('MONGO_INITDB_ROOT_PASSWORD'),
            'ssl' => false,
            'authSource' => 'admin',
        ],
        []
    ));

$container->set('db', function (ContainerInterface $container) {
    return $container->get(Client::class);
});

$container->set(UserFactoryInterface::class, DI\create(UserFactory::class));
$container->set('userFactory', function (ContainerInterface $container) {
    return $container->get(UserFactoryInterface::class);
});

$container->set(
    UserRepositoryInterface::class,
    DI\create(UserRepository::class)->constructor(
        DI\get('db'),
        DI\get('userFactory'),
        DI\get('validator'),
    ));
$container->set('userRepository', function (ContainerInterface $container) {
    return $container->get(UserRepositoryInterface::class);
});

$container->set(CommentFactoryInterface::class, DI\create(CommentFactory::class)->constructor($container));
$container->set('commentFactory', function (ContainerInterface $container) {
    return $container->get(CommentFactoryInterface::class);
});
$container->set(
    CommentRepositoryInterface::class,
    DI\create(CommentRepository::class)->constructor(
        DI\get('db'),
        DI\get('commentFactory'),
        DI\get('validator'),
    ));
$container->set('commentRepository', function (ContainerInterface $container) {
    return $container->get(CommentRepositoryInterface::class);
});

$container->set(PrFactoryInterface::class, DI\create(PrFactory::class)->constructor($container));
$container->set('prFactory', function (ContainerInterface $container) {
    return $container->get(PrFactoryInterface::class);
});
$container->set(
    PrRepositoryInterface::class,
    DI\create(PrRepository::class)->constructor(
        DI\get('db'),
        DI\get('prFactory'),
        DI\get('validator'),
    ));
$container->set('prRepository', function (ContainerInterface $container) {
    return $container->get(PrRepositoryInterface::class);
});

$container->set('validator', function () {
    return new Awurth\SlimValidation\Validator();
});

return $container;