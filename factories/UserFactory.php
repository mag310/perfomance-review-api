<?php

namespace app\factories;

use app\entities\User;
use app\interfaces\UserFactoryInterface;
use app\interfaces\UserInterface;
use ArrayObject;

class UserFactory implements UserFactoryInterface
{
    /** @var int Длинна токена в байтах */
    private const AUTH_TOKEN_LENGTH = 16;

    /**
     * @param ArrayObject $arrayObject
     * @return mixed
     */
    public function createFromArrayObject(ArrayObject $arrayObject): UserInterface
    {
        $data = $arrayObject->getArrayCopy();

        $user = new User();
        $user->setId((string)($data['_id'] ?? ''));
        $user->fio = $data['fio'] ?? '';
        $user->authToken = $data['authToken'] ?? '';
        $user->phone = $data['phone'] ?? '';

        return $user;
    }

    /**
     * @param array $array
     * @return UserInterface
     * @throws \Exception
     */
    public function createFromArray(array $array): UserInterface
    {
        $user = new User();
        $user->phone = $array['phone'];
        $user->fio = $array['fio'] ?? 'Unnamed';
        $user->authToken = bin2hex(random_bytes(self::AUTH_TOKEN_LENGTH));

        return $user;
    }
}