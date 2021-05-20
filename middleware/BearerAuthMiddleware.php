<?php

namespace app\middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;

/**
 * Авторизация по Bearer токену
 */
class BearerAuthMiddleware implements MiddlewareInterface
{
    /** @var App */
    private $app;

    /** @var ResponseFactoryInterface */
    private $responseFactory;

    /**
     * BearerAuthMiddleware constructor.
     *
     * @param App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->responseFactory = $app->getResponseFactory();
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
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeader('Authorization');
        if (empty($token)) {

            $body = $this->createStream('Unauthorized');

            return $this->responseFactory
                ->createResponse(401)
                ->withAddedHeader('WWW-Authenticate', 'Bearer')
                ->withBody($body);
        }

        /** @var ServerRequestInterface $request */
        return $handler->handle($request);
    }

    /**
     * @return \Slim\Psr7\Factory\StreamFactory
     */
    protected function getStreamFactory()
    {
        return new \Slim\Psr7\Factory\StreamFactory();
    }

    /**
     * @param string $contents
     * @return StreamInterface
     */
    protected function createStream(string $contents = ''): StreamInterface
    {
        return $this->getStreamFactory()->createStream($contents);
    }
}