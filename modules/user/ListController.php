<?php

namespace app\modules\user;

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

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     * @return ResponseInterface
     * @throws HttpUnauthorizedException
     */
    public function list(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->container->has('user')) {
            throw new HttpUnauthorizedException($request, 'User not found!');
        }

        $params = $request->getQueryParams();

        $filter = [];

        $users = $this->repository->findAll($filter, [
            'limit' => (int)($params['limit'] ?? 5),
            'skip'  => (int)($params['offset'] ?? 0),
        ]);

        $rows = [];
        foreach ($users as $user) {
            $rows[] = $this->factory->createArrayObject($user, ['id', 'fio']);
        }
        /** @var UserFactoryInterface $fabric */
        $body = json_encode($rows);

        $response = $response->withAddedHeader('Content-Type', 'application/json');
        $response->getBody()->write($body);

        return $response;
    }
}