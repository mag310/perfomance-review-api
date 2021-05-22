<?php

namespace app\repositories;

use app\interfaces\CommentFactoryInterface;
use app\interfaces\CommentInterface;
use app\interfaces\CommentRepositoryInterface;
use Awurth\SlimValidation\Validator;
use MongoDB\Client;
use MongoDB\Collection;
use Psr\Container\ContainerInterface;

class CommentRepository implements CommentRepositoryInterface
{
    /** @var ContainerInterface */
    private $db;
    /** @var Client */
    private $factory;
    /** @var Validator */
    private $validator;
    /** @var Collection */
    private $collection;

    public function __construct(Client $db, CommentFactoryInterface $factory, Validator $validator)
    {
        $this->db = $db;
        $this->factory = $factory;
        $this->validator = $validator;
        $this->collection = $this->db->perfomance->comment;
    }

    public function get(string $id)
    {
        return $this->collection->findOne(['id' => $id]);
    }

    public function has(string $id): bool
    {
        return $this->collection->findOne(['id' => $id]) !== null;
    }

    public function save(CommentInterface $entity): bool
    {
        if ($entity->getId() !== null) {
            $this->collection->updateOne(['_id' => new ObjectId($entity->getId())], $entity);
        } else {
            $res = $this->collection->insertOne($entity);
            $entity->setId($res->getInsertId());
        }

        return true;
    }
}