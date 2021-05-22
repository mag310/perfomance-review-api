<?php

namespace app\interfaces;

use Psr\Container\ContainerInterface;

interface CommentRepositoryInterface extends ContainerInterface
{
    public function save(CommentInterface $entity): bool;
}