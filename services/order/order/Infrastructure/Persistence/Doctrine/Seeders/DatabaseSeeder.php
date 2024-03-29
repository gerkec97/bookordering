<?php

namespace GkOrder\Infrastructure\Persistence\Doctrine\Seeders;

use Doctrine\ORM\EntityManagerInterface;

class DatabaseSeeder
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var array */
    protected $references = [];

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Register database seeders here
     */
    public function run()
    {
        $this->call(ExampleSeeder::class);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getReference(string $name)
    {
        return $this->references[$name] ?? null;
    }

    /**
     * @param string $name
     * @param $object
     */
    public function setReference(string $name, $object)
    {
        $this->references[$name] = $object;
    }

    /**
     * @param string $name
     */
    private function call(string $name)
    {
        (new $name($this))->run();
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Persist given object and flush
     *
     * @var mixed $object
     */
    public function persist($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }
}