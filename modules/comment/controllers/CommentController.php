<?php

namespace app\modules\comment\controllers;

use app\interfaces\CommentFactoryInterface;
use app\interfaces\CommentRepositoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class CommentController
{
    private $container;
    private $repository;
    private $factory;

    public function __construct(ContainerInterface $container, CommentRepositoryInterface $repository, CommentFactoryInterface $factory)
    {
        $this->container = $container;
        $this->repository = $repository;
        $this->factory = $factory;
    }

    public function add(ServerRequestInterface $request, $response)
    {
        $user = $this->container->get('user');
        $entity = $this->factory->createComment($request->getParsedBody());


        //Наход пр по ид который передали
        //Валидируем входные параметры
        //Добавляем в репозиторий
        //$this->repository->add($entity);
        //ВОзвращаем результат
    }

    public function edit(ServerRequestInterface $request)
    {
        //Получаем реквест с пользователем
        $entity = $this->factory->createComment($request->getBody()->getContents());
        //Наход пр по ид который передали
        //Валидируем входные параметры
        //Обновляем в репозиторий
        //$this->repository->edit($entity);
        //ВОзвращаем результат
    }
}