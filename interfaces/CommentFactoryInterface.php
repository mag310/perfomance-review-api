<?php

namespace app\interfaces;

use ArrayObject;

interface CommentFactoryInterface
{
    /**
     * @param CommentInterface $comment
     * @return ArrayObject
     */
    public function createArrayObject(CommentInterface $comment): ArrayObject;

    /**
     * @param array $array
     * @return PrInterface
     */
    public function createFromArray(array $array): CommentInterface;
}