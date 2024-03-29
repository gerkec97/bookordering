<?php

namespace GkOrder\Infrastructure\Hydrator;

use GkOrder\Domain\Core\Hydrator\HydratorInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Hydrator implements HydratorInterface
{
    /** @var array */
    protected $normalizers = [];

    /** @var array */
    protected $serializers = [];

    /**
     * Hydrator constructor.
     */
    public function __construct()
    {
        $objectNormalizer = new ObjectNormalizer();
        $this->normalizers[] = $objectNormalizer;
    }

    /**
     * @inheritdoc
     */
    public function hydrate($object, array $array)
    {
        return $this->getSerializer()
            ->denormalize($array, get_class($object), null, ['object_to_populate' => $object]);
    }

    /**
     * @inheritdoc
     */
    public function extract($object)
    {
        return $this->getSerializer()->normalize($object);
    }

    /**
     * @return Serializer
     */
    private function getSerializer()
    {
        return new Serializer($this->normalizers, $this->serializers);
    }
}