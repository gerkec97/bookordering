<?php

namespace EmeraldIsland\Infrastructure\Persistence\Doctrine\Repositories\Domain;

use EmeraldIsland\Domain\Domain\Repositories\UserRepositoryInterface;
use EmeraldIsland\Infrastructure\Persistence\Doctrine\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $acceptedFilters = [ 'username' => 'e.username' ];
}