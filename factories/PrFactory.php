<?php


namespace app\factories;

use app\entities\Pr;
use app\interfaces\PrFactoryInterface;
use app\interfaces\PrInterface;
use ArrayObject;
use Exception;
use LogicException;
use MongoDB\Model\BSONDocument;
use Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class PrFactory implements PrFactoryInterface
{
    /** @var ContainerInterface */
    private $container;
    /** @var V */
    private $validator;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->validator = $this->container->get('validator');
    }

    /**
     * @param array $array
     * @return PrInterface
     * @throws Exception
     */
    public function createFromArray(array $array): PrInterface
    {
        $pr = new Pr();

        return $pr;
    }

    /**
     * @param PrInterface $pr
     * @return ArrayObject
     */
    public function createArrayObject(PrInterface $pr): ArrayObject
    {
        /** @var PrInterface $pr */
        $array = new BSONDocument();

        $array['id'] = $pr->getId();
        $array['userId'] = $pr->getUserId();
        $array['managerId'] = $pr->getManagerId();
        $array['resume'] = $pr->getResume();

        return $array;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function createGuid()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        if (function_exists('random_bytes') === true) {
            $data = random_bytes(16);
        } elseif (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
        } else {
            throw new LogicException('Random bytes generator not installed!');
        }

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}