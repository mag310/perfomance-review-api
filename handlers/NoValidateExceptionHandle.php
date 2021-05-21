<?php

namespace app\handlers;

use app\renderers\JsonNoValidationExceptionRenderer;
use Slim\Handlers\ErrorHandler;
use Slim\Interfaces\ErrorRendererInterface;

class NoValidateExceptionHandle extends ErrorHandler
{
    /**
     * @var string
     */
    protected $defaultErrorRendererContentType = 'application/json';

    /**
     * @var ErrorRendererInterface|string|callable
     */
    protected $defaultErrorRenderer = JsonNoValidationExceptionRenderer::class;

}