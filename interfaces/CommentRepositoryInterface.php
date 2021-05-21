<?php

namespace app\interfaces;

use Psr\Container\ContainerInterface;

interface CommentRepositoryInterface extends ContainerInterface
{
    public function add(CommentInterface $entity);

    public function edit(CommentInterface $entity);
}