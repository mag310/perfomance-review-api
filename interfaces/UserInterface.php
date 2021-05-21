<?php

namespace app\interfaces;

interface UserInterface
{
    /** @return mixed */
    public function getId();

    /** @param mixed */
    public function setId($id);

    /** @return string */
    public function getAuthToken(): ?string;
}