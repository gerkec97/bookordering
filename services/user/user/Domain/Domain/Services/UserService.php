<?php

namespace EmeraldIsland\Domain\Domain\Services;

use Assert\Assert;
use Assert\LazyAssertionException;
use Carbon\Carbon;
use EmeraldIsland\Domain\Domain\Entities\User;
use EmeraldIsland\Domain\Domain\Exceptions\UserNotFoundException;
use EmeraldIsland\Domain\Domain\Repositories\UserRepositoryInterface;
use EmeraldIsland\Domain\Core\Hydrator\HydratorInterface;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Query;

class UserService implements UserServiceInterface
{
    /** @var UserRepositoryInterface */
    protected $userRepository;

    /** @var HydratorInterface */
    protected $hydrator;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        HydratorInterface $hydrator
    )
    {
        $this->userRepository = $userRepository;
        $this->hydrator = $hydrator;
    }

    /**
     * @inheritdoc
     */
    public function getUser(int $id): User
    {
        $user = $this->userRepository->findOne($id);

        if (! $user) {
            throw UserNotFoundException::byId($id);
        }

        return $user;
    }

    /**
     *
     * @param $username
     * @return \EmeraldIsland\Domain\Domain\Entities\User
     */
    public function getByUserName($username) {
        $query = Query::createFromFilters([new Equals('username', $username)]);
        $user = $this->userRepository->findOneByQuery($query);

        if (! $user) {
            throw UserNotFoundException::byUserName($username);
        }

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function getUsers(Query $query): array
    {
        return $this->userRepository->findAllByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function getUsersPaginated(Query $query): PaginatorInterface
    {
        return $this->userRepository->findPaginatedByQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function createUser(array $data): User
    {
        $this->validateInput($data);

        $user = new User($data['username']);
        $this->hydrator->hydrate($user, $data);

        return $this->userRepository->save($user);
    }

    /**
     * @inheritdoc
     */
    public function updateUser(string $username, array $data): User
    {
        $data['username'] = $username;
        $this->validateInput($data);

        $user = $this->getByUserName($username);

        if (! $user) {
            throw UserNotFoundException::byUserName($username);
        }

        $this->hydrator->hydrate($user, $data);
        $user->setUpdatedAt(Carbon::now());

        return $this->userRepository->save($user);
    }

    /**
     * @inheritdoc
     */
    public function deleteUser(string $username)
    {
        $user = $this->getByUserName($username);

        if (! $user) {
            throw UserNotFoundException::byUserName($username);
        }

        $this->userRepository->remove($user);
    }

    /**
     * @param $data
     * @throws LazyAssertionException
     */
    private function validateInput($data)
    {
        Assert::lazy()
            ->that($data['username'],'username')->string()
            ->that($data['email'], 'email')->email()
            ->that($data['last_name'], 'last_name')->nullOr()->string()
            ->that($data['first_name'], 'first_name')->nullOr()->string()
            ->verifyNow();
    }

}