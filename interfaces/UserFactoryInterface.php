<?php

namespace app\interfaces;

use ArrayObject;

interface UserFactoryInterface
{
    /**
     * @param ArrayObject $arrayObject
     * @return mixed
     */
    public function createFromArrayObject(ArrayObject $arrayObject): UserInterface;

    /**
     * @param UserInterface $user
     * @return ArrayObject
     */
    public function createArrayObject(UserInterface $user): ArrayObject;

    /**
     * @param array $array
     * @return UserInterface
     */
    public function createFromArray(array $array): UserInterface;
}