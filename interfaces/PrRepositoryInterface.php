<?php

namespace app\interfaces;

use Psr\Container\ContainerInterface;

interface PrRepositoryInterface extends ContainerInterface
{
    public function save(PrInterface $entity): bool;
}