<?php

namespace app\modules\user;

use app\entities\User;
use app\interfaces\UserFactoryInterface;
use app\interfaces\UserRepositoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

/**
 * Class DefaultController
 *
 * @package app\modules\main
 */
class DefaultController
{
    /** @var ContainerInterface */
    private $container;

    /** @var UserFactoryInterface */
    private $factory;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->factory = $this->container->get('userFactory');
    }

    /**
     * Начальная страница
     *
     * @api GET /
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     * @return ResponseInterface
     * @throws HttpUnauthorizedException
     */
    public function info(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
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

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     * @return ResponseInterface
     * @throws HttpUnauthorizedException
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if (!$this->container->has('user')) {
            throw new HttpUnauthorizedException($request, 'User not found!');
        }

        /** @var User $user */
        $user = $this->container->get('user');

        $data = $request->getParsedBody();
        foreach ($data as $key => $val) {
            if (property_exists(User::class, $key)) {
                $user->$key = $val;
            }
        }
        /** @var UserRepositoryInterface $fabric */
        $repository = $this->container->get('userRepository');
        $repository->save($user);

        /** @var UserFactoryInterface $fabric */
        $body = json_encode($this->factory->createArrayObject($user));

        $response = $response
            ->withStatus(202)
            ->withAddedHeader('Content-Type', 'application/json');

        $response->getBody()->write($body);

        return $response;
    }
}