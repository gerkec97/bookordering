<?php

namespace GkCatalog\Domain\Core\Hydrator;

interface HydratorInterface
{
    /**
     * Hydrates a object from given array
     *
     * @param $object
     * @param array $array
     * @return mixed
     */
    public function hydrate($object, array $array);

    /**
     * Extracts an object to a array
     *
     * @param $object
     * @return array
     */
    public function extract($object);
}