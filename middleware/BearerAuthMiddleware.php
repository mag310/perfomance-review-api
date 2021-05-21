<?php

namespace app\middleware;

use app\interfaces\UserRepositoryInterface;
use app\entities\User;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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

    /** @var ContainerInterface; */
    private $container;

    /**
     * BearerAuthMiddleware constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
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
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        [$token] = $request->getHeader('Authorization');

        if (empty($token)) {
            return $handler->handle($request);
        }

        if (!preg_match('#^Bearer ([0-9a-f]+)$#', $token, $matches)) {
            return $handler->handle($request);
        }

        /** @var UserRepositoryInterface $repository */
        $repository = $this->container->get('userRepository');
        if ($user = $repository->findByToken($token)) {
            $this->container->set('user', $user);
        }else{
            $this->container->set('user', new User());
        }

        /** @var ServerRequestInterface $request */
        return $handler->handle($request);
    }
}