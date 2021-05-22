<?php

namespace app\entities;

use app\interfaces\PrInterface;

/**
 * Пользователь
 */
class Pr implements PrInterface
{
    /** @var mixed */
    private $id;

    /** @var int */
    public $userId;
    /** @var int */
    public $managerId;
    /** @var string */
    public $resume;
    /** @var string */
    public $status = 'add';

    /** @return mixed */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id): PrInterface
    {
        $this->id = $id;

        return $this;
    }

    /** @return string */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(?string $userId): PrInterface
    {
        $this->userId = $userId;

        return $this;
    }

    /** @return int */
    public function getManagerId(): ?string
    {
        return $this->managerId;
    }

    public function setManagerId(?string $managerId): PrInterface
    {
        $this->managerId = $managerId;

        return $this;
    }

    public function setResume(?string $resume): PrInterface
    {
        $this->resume = $resume;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}