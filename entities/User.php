<?php

namespace app\entities;

use app\interfaces\UserInterface;

/**
 * Пользователь
 */
class User implements UserInterface
{
    /** @var mixed */
    private $id;
    /** @var string */
    private $authToken;

    /** @var string */
    public $phone;
    /** @var string */
    public $fio;

    /** @return mixed */
    public function getId()
    {
        return $this->id;
    }

    /** @return string */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /** @inheritDoc */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /** @inheritDoc */
    public function setAuthToken(?string $authToken): void
    {
        $this->authToken = $authToken;
    }
}