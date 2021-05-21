<?php

namespace app\exceptions;

use RuntimeException;

class NoValidationException extends RuntimeException
{
    private $errors;

    public function __construct(array $errors)
    {
        parent::__construct('');
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}