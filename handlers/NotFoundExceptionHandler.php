<?php


namespace app\handlers;


use Slim\Error\Renderers\JsonErrorRenderer;
use Slim\Handlers\ErrorHandler;
use Slim\Interfaces\ErrorRendererInterface;

class NotFoundExceptionHandler extends ErrorHandler
{
    /**
     * @var string
     */
    protected $defaultErrorRendererContentType = 'application/json';

    /**
     * @var ErrorRendererInterface|string|callable
     */
    protected $defaultErrorRenderer = JsonErrorRenderer::class;
}