<?php

namespace app\models;

use app\interfaces\UserInterface;

/**
 * Пользователь
 */
class User implements UserInterface
{
    /** @var mixed */
    public $id;
    /** @var string */
    public $phone;
    /** @var string */
    public $fio;

    /** @return mixed */
    public function getId()
    {
        return $this->id;
    }
}