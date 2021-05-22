<?php

namespace app\modules\comment\controllers;

use app\interfaces\CommentFactoryInterface;
use app\interfaces\CommentRepositoryInterface;
use app\interfaces\PrRepositoryInterface;
use app\interfaces\UserInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class CommentController
{
    /** @var ContainerInterface */
    private $container;
    /** @var CommentRepositoryInterface */
    private $repository;
    /** @var CommentFactoryInterface */
    private $factory;
    /** @var PrRepositoryInterface */
    private $prRepository;

    public function __construct(
        ContainerInterface $container,
        CommentRepositoryInterface $repository,
        CommentFactoryInterface $factory,
        PrRepositoryInterface $prRepository
    )
    {
        $this->container = $container;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->prRepository = $prRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     * @throws HttpNotFoundException
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response)
    {
        /** @var UserInterface $user */
        $user = $this->container->get('user');
        $entity = $this->factory->createComment($request->getParsedBody());
        $pr = $this->prRepository->get($entity->getPrId());
        if (!$pr) {
            throw new HttpNotFoundException($request);
        }
        $entity->setAuthorId($user->getId());
        $this->repository->save($entity);

        return $response->withJson($entity);
    }
}