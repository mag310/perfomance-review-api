<?php

namespace app\modules\main;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class DefaultController
 *
 * @package app\modules\main
 */
class DefaultController
{
    /** @var ContainerInterface */
    private $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Начальная страница
     *
     * @api GET /
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     * @return ResponseInterface
     */
    public function home(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if ($this->container->has('user')) {
            $body = json_encode($this->container->get('user'));
        } else {
            $body = 'User not found!';
        }

        $response = $response->withAddedHeader('Content-Type', 'application/json');
        $response->getBody()->write($body);

        return $response;
    }

}