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
    public $phone;
    /** @var string */
    public $fio;
    /** @var string */
    public $authToken;

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

    /** @param mixed */
    public function setId($id)
    {
        $this->id = $id;
    }
}