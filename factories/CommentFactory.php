<?php


namespace app\factories;

use app\exceptions\NoValidationException;
use app\interfaces\CommentInterface;
use Respect\Validation\Validator as V;
use app\entities\Comment;
use app\interfaces\CommentFactoryInterface;
use DI\Container;

class CommentFactory implements CommentFactoryInterface
{
    private $container;
    /** @var V */
    private $validator;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->validator = $this->container->get('validator');
    }

    public function createComment(array $data)
    {
        $entity = new Comment();
        foreach ($data as $key => $value) {
            if (property_exists(Comment::class, $key)) {
                $entity->$key = $value;
            }
        }

        $this->validateComment($entity);
    }

    private function validateComment(CommentInterface $entity): void
    {
        $validator = $this->validator->array($entity->toArray(), [
            'prId' => V::numeric(),
            'authorId' => V::numeric(),
            'rating' => V::numeric(),
            'text' => V::notBlank(),
        ]);

        if (!$validator->isValid()) {
            throw  new NoValidationException($validator->getErrors());
        }
    }
}