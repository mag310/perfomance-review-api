<?php

namespace app\repositories;

use app\interfaces\UserFactoryInterface;
use app\interfaces\UserInterface;
use app\interfaces\UserRepositoryInterface;
use Awurth\SlimValidation\Validator;
use DI\NotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Model\BSONDocument;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Respect\Validation\Validator as V;

class UserRepository implements UserRepositoryInterface
{
    /** @var Client */
    private $db;
    /** @var UserFactoryInterface */
    private $factory;

    /** @var Collection */
    private $collection;

    /** @var Validator */
    private $validator;

    /**
     * UserRepository constructor.
     *
     * @param Client               $db
     * @param UserFactoryInterface $factory
     * @param Validator            $validator
     */
    public function __construct(Client $db, UserFactoryInterface $factory, Validator $validator)
    {
        $this->db = $db;
        $this->collection = $this->db->perfomance->user;
        $this->factory = $factory;
        $this->validator = $validator;
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
        $res = $this->collection->findOne(['id' => $id]);
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
        return $this->collection->findOne(['id' => $id]) !== null;
    }

    /**
     * @param string $token
     * @return UserInterface|null
     */
    public function findByToken(string $token): ?UserInterface
    {
        /** @var BSONDocument $res */
        $res = $this->collection->findOne(['authToken' => $token]);
        if (!$res) {
            return null;
        }

        return $this->factory->createFromArrayObject($res);
    }

    /**
     * @param string $phone
     * @return UserInterface|null
     */
    public function findByPhone(string $phone): ?UserInterface
    {
        /** @var BSONDocument $res */
        $res = $this->collection->findOne(['phone' => $phone]);
        if (!$res) {
            return null;
        }

        return $this->factory->createFromArrayObject($res);
    }

    /**
     * @param UserInterface $user
     * @return bool
     */
    public function save(UserInterface $user): bool
    {
        if ($user->getId() !== null) {
            $res = $this->collection->updateOne(['_id' => new ObjectId($user->getId())], $user);
        } else {
            $res = $this->collection->insertOne($user);
            $user->setId($res->getInsertedId());
        }

        return true;
    }
}