<?php

namespace app\modules\chat;

use app\interfaces\UserFactoryInterface;
use app\interfaces\UserRepositoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MessageController
{
    /** @var ContainerInterface */
    private $container;

    /** @var UserFactoryInterface */
    private $factory;

    /** @var UserRepositoryInterface */
    private $repository;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->repository = $this->container->get('userRepository');
        $this->factory = $this->container->get('userFactory');
    }

    public function unSending(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {

        /** @var UserFactoryInterface $fabric */
        $body = json_encode([['chatId' => '121312311', 'message' => 'Тестовое сообщение']]);

        $response = $response->withAddedHeader('Content-Type', 'application/json');
        $response->getBody()->write($body);

        return $response;
    }
}