<?php

namespace app\factories;

use app\entities\User;
use app\interfaces\UserFactoryInterface;
use app\interfaces\UserInterface;
use ArrayObject;
use Exception;
use LogicException;
use MongoDB\Model\BSONDocument;

class UserFactory implements UserFactoryInterface
{
    /** @var int Длинна токена в байтах */
    private const AUTH_TOKEN_LENGTH = 16;

    /**
     * @param ArrayObject $arrayObject
     * @return User
     * @throws Exception
     */
    public function createFromArrayObject(ArrayObject $arrayObject): UserInterface
    {
        $data = $arrayObject->getArrayCopy();

        $user = new User();
        $user->setId((string)($data['id'] ?? $this->createGuid()));
        $user->fio = $data['fio'] ?? '';
        $user->setAuthToken($data['authToken'] ?? null);
        $user->phone = $data['phone'] ?? '';

        return $user;
    }

    /**
     * @param array $array
     * @return UserInterface
     * @throws Exception
     */
    public function createFromArray(array $array): UserInterface
    {
        $user = new User();
        $user->phone = $array['phone'];
        $user->fio = $array['fio'] ?? '';
        $user->chatId = $array['chatId'] ?? 0;

        $user->setId($array['id'] ?? $this->createGuid());
        $user->setAuthToken($this->createAuthToken());

        return $user;
    }

    /**
     * @param UserInterface $user
     * @return ArrayObject
     */
    public function createArrayObject(UserInterface $user): ArrayObject
    {
        /** @var User $user */
        $array = new BSONDocument();

        $array['id'] = $user->getId();
        $array['phone'] = $user->phone;
        $array['fio'] = $user->fio;
        $array['authToken'] = $user->getAuthToken();
        $array['chatId'] = $user->chatId;

        return $array;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function createAuthToken()
    {
        return bin2hex(random_bytes(self::AUTH_TOKEN_LENGTH));
    }

    /**
     * @return string
     * @throws Exception
     */
    public function createGuid()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        if (function_exists('random_bytes') === true) {
            $data = random_bytes(16);
        } elseif (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
        } else {
            throw new LogicException('Random bytes generator not installed!');
        }

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}