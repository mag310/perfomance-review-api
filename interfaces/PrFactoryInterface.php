<?php

namespace app\interfaces;

use ArrayObject;

interface PrFactoryInterface
{
    /**
     * @param PrInterface $pr
     * @return ArrayObject
     */
    public function createArrayObject(PrInterface $pr): ArrayObject;

    /**
     * @param array $array
     * @return PrInterface
     */
    public function createFromArray(array $array): PrInterface;
}