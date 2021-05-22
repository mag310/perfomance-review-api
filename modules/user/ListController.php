<?php

namespace app\modules\user;

use app\entities\User;
use app\interfaces\UserFactoryInterface;
use app\interfaces\UserRepositoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class ListController
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

    public function list(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if (!$this->container->has('user')) {
            throw new HttpUnauthorizedException($request, 'User not found!');
        }

        /** @var User $user */
        $user = $this->container->get('user');

        /** @var UserFactoryInterface $fabric */
        $body = json_encode($this->factory->createArrayObject($user));

        $response = $response->withAddedHeader('Content-Type', 'application/json');
        $response->getBody()->write($body);

        return $response;
    }
}