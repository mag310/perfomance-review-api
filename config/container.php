<?php

use app\factories\UserFactory;
use app\interfaces\UserFactoryInterface;
use app\interfaces\UserRepositoryInterface;
use app\repositories\UserRepository;
use app\entities\Comment;
use app\factories\CommentFactory;
use app\interfaces\CommentFactoryInterface;
use app\interfaces\CommentInterface;
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

$container->set(CommentInterface::class, DI\create(Comment::class)->constructor($container));
$container->set(CommentRepositoryInterface::class, DI\create(CommentRepository::class)->constructor($container));
$container->set(CommentFactoryInterface::class, DI\create(CommentFactory::class)->constructor($container));

$container->set('validator', function () {
    return new Awurth\SlimValidation\Validator();
});

return $container;