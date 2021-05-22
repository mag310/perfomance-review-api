<?php

namespace app\interfaces;

interface UserInterface
{
    /** @return mixed */
    public function getId();

    /**
     * @param mixed $id
     * @return void
     */
    public function setId($id): void;

    /** @return string */
    public function getAuthToken(): ?string;

    /**
     * @param string|null $authToken
     * @return void
     */
    public function setAuthToken(?string $authToken): void;

}