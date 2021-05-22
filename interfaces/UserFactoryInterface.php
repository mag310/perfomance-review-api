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
     * @param array|null    $fields
     * @return ArrayObject
     */
    public function createArrayObject(UserInterface $user, ?array $fields = null): ArrayObject;

    /**
     * @param array $array
     * @return UserInterface
     */
    public function createFromArray(array $array): UserInterface;
}