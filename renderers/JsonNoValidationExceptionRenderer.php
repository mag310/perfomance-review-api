<?php

namespace app\renderers;

use app\exceptions\NoValidationException;

class JsonNoValidationExceptionRenderer
{
    /**
     * @param NoValidationException $exception
     * @param bool      $displayErrorDetails
     * @return string
     */
    public function __invoke(NoValidationException $exception, bool $displayErrorDetails): string
    {
        $response = ['success' => false, 'errors' => $exception->getErrors()];

        return (string) json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}