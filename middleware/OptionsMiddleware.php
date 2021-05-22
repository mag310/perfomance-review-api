<?php

namespace app\middleware;

use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Psr7\Response;

/**
 * 401 Если не авторизован
 */
class OptionsMiddleware implements MiddlewareInterface
{
    private const METHOD_OPTIONS = 'OPTIONS';

    /** @var Container; */
    private $container;

    /**
     * BearerAuthMiddleware constructor.
     *
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws HttpUnauthorizedException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getMethod() !== self::METHOD_OPTIONS) {
            return $handler->handle($request);
        }

        $response = new Response();

        $methods = ['GET', 'POST', 'DELETE', 'PUT', 'OPTIONS'];
        return $response
            ->withHeader('Vary', 'Origin')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', '*')//implode(',', ['Authorization']))
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Methods', implode(',', $methods));
    }
}