<?php

namespace GkCatalog\Infrastructure\Persistence\Doctrine\Seeders;

class ExampleSeeder
{
    /** @var DatabaseSeeder */
    private $databaseSeeder;

    /**
     * @param DatabaseSeeder $databaseSeeder
     */
    public function __construct(DatabaseSeeder $databaseSeeder)
    {
        $this->databaseSeeder = $databaseSeeder;
    }

    /**
     * Seed the database table
     *
     * @return void
     */
    public function run()
    {
        $entityManager = $this->databaseSeeder->getEntityManager();

        // Create object and given object to the $this->persist($object);
    }
}