<?php

namespace app\repositories;

use app\interfaces\UserInterface;
use app\interfaces\UserRepositoryInterface;
use DI\NotFoundException;
use MongoDB\Client;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserRepository implements UserRepositoryInterface
{
    /** @var ContainerInterface */
    private $container;
    /** @var Client */
    private $db;

    /**
     * UserRepository constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $this->container->get('db');
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return mixed Entry.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     */
    public function get(string $id)
    {
        $res = $this->db->perfomance->user->findOne(['id' => $id]);
        if ($res === null) {
            throw new NotFoundException('User not found!');
        }

        return $res;
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has(string $id)
    {
        return $this->db->perfomance->user->findOne(['id' => $id]) !== null;
    }

    /**
     * @param string $token
     * @return UserInterface|null
     */
    public function findByToken(string $token): ?UserInterface
    {
        return $this->db->perfomance->user->findOne(['token' => $token]);
    }
}