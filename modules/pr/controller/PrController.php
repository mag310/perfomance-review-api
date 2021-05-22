<?php


namespace app\modules\pr\controller;

use app\entities\Pr;
use app\entities\User;
use app\interfaces\PrFactoryInterface;
use app\interfaces\PrRepositoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class PrController
{
    /** @var ContainerInterface */
    private $container;

    /** @var PrFactoryInterface */
    private $factory;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->factory = $this->container->get('prFactory');
    }

    public function save(ServerRequestInterface $request, ResponseInterface $response)
    {
        if (!$this->container->has('user')) {
            throw new HttpUnauthorizedException($request, 'User not found!');
        }

        /** @var User $user */
        $user = $this->container->get('user');

        $pr = new Pr();
        $pr->setUserId($user->getId());

        $data = $request->getParsedBody();
        foreach ($data as $key => $val) {
            if (property_exists(Pr::class, $key)) {
                $pr->$key = $val;
            }
        }

        /** @var PrRepositoryInterface $repository */
        $repository = $this->container->get('prRepository');
        $repository->save($pr);

        $body = json_encode($this->factory->createArrayObject($pr));

        $response = $response
            ->withStatus(202)
            ->withAddedHeader('Content-Type', 'application/json')
            ->withAddedHeader('Location', '/pr/' . $pr->getId());

        $response->getBody()->write($body);
    }
}