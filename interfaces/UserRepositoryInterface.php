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

    /**
     * @param string $phone
     * @return UserInterface|null
     */
    public function findByPhone(string $phone): ?UserInterface;

    /**
     * @param UserInterface $user
     * @return bool
     */
    public function save(UserInterface $user): bool;
}