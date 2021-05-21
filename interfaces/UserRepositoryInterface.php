<?php

namespace app\interfaces;

use Psr\Container\ContainerInterface;

interface UserRepositoryInterface extends ContainerInterface
{
    /**
     * @param string $token
     * @return UserInterface|null
     */
    public function findByToken(string $token): ?UserInterface;
}