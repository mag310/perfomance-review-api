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
     * @re
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

//
//        $database = $this->container->get('db');
//        $collection = $database->perfomance->perfomance;
//        $cursor = $collection->find([]);
//
//        foreach ($cursor as $document) {
//            $body .= "<pre>";
//            $body .= var_export($document, true);
//            $body .= "</pre><br>\n";
//        }

        $response->getBody()->write($body);

        return $response;
    }

}