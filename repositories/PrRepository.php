<?php

namespace app\repositories;

use app\interfaces\PrFactoryInterface;
use app\interfaces\PrInterface;
use app\interfaces\PrRepositoryInterface;
use Awurth\SlimValidation\Validator;
use MongoDB\Client;
use MongoDB\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PrRepository implements PrRepositoryInterface
{
    /** @var Client */
    private $db;
    /** @var PrFactoryInterface */
    private $factory;

    /** @var Collection */
    private $collection;

    /** @var Validator */
    private $validator;

    /**
     * UserRepository constructor.
     *
     * @param Client               $db
     * @param PrFactoryInterface $factory
     * @param Validator            $validator
     */
    public function __construct(Client $db, PrFactoryInterface $factory, Validator $validator)
    {
        $this->db = $db;
        $this->collection = $this->db->perfomance->pr;
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
        return $this->collection->findOne(['id' => $id]);
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
    public function has(string $id): bool
    {
        return $this->collection->findOne(['id' => $id]) !== null;
    }

    public function save(PrInterface $entity): bool
    {
        $data = $this->factory->createArrayObject($entity);

        $updateResult = $this->collection->updateOne(
            ['id' => $entity->getId()],
            ['$set' => $data],
            ['upsert' => true]
        );

        return true;
    }
}