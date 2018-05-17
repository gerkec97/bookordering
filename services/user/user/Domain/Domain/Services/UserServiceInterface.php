<?php

namespace EmeraldIsland\Domain\Domain\Services;

use EmeraldIsland\Domain\Domain\Entities\User;
use EmeraldIsland\Domain\Domain\Exceptions\UserNotFoundException;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Query;

interface UserServiceInterface
{
    /**
     * @return User
     */
    public function createUser(array $data): User;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getUser(int $id): User;

    /**
     * @param Query $query
     * @return array
     */
    public function getUsers(Query $query): array;

    /**
     * @param Query $query
     * @return PaginatorInterface
     */
    public function getUsersPaginated(Query $query): PaginatorInterface;

    /**
     * @param string $username
     * @param array $data
     * @throws UserNotFoundException
     * @return User
     */
    public function updateUser(string $usename, array $data): User;

    /**
     * @param string $username
     * @throws UserNotFoundException
     * @return void
     */
    public function deleteUser(string $username);
}