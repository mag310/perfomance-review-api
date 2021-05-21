<?php

namespace app\modules\auth;

use app\exceptions\NoValidationException;
use app\interfaces\UserFactoryInterface;
use app\interfaces\UserRepositoryInterface;
use Awurth\SlimValidation\Validator;
use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator as V;

class LoginController
{
    /** @var ContainerInterface */
    private $container;
    /** @var UserRepositoryInterface */
    private $repository;
    /** @var UserFactoryInterface */
    private $fabric;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->repository = $this->container->get('userRepository');
        $this->fabric = $this->container->get('userFactory');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     * @return ResponseInterface
     * @throws Exception
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();

        /** @var Validator $validator */
        $validator = $this->container->get('validator')->array($data, [
            'phone' => V::notBlank(),
        ]);
        if (!$validator->isValid()) {
            throw new NoValidationException($validator->getErrors());
        }

        if (!$user = $this->repository->findByPhone($data['phone'])) {
            $user = $this->fabric->createFromArray($data);
            $this->repository->save($user);
        }

        $response = $response->withAddedHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($user));
        return $response;
    }
}