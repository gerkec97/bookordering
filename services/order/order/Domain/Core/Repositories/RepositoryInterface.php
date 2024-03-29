<?php

namespace GkOrder\Domain\Core\Repositories;

use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Query;

interface RepositoryInterface
{
    /**
     * Finds one result
     *
     * @param mixed $id
     * @return mixed
     */
    public function findOne($id);

    /**
     * Find one result by given query
     *
     * @param Query $query
     * @return mixed
     */
    public function findOneByQuery(Query $query);

    /**
     * Find results by given query
     *
     * @param Query $query
     * @return array
     */
    public function findAllByQuery(Query $query): array;

    /**
     * Find paginated results by given query
     *
     * @param Query $query
     * @return PaginatorInterface
     */
    public function findPaginatedByQuery(Query $query): PaginatorInterface;

    /**
     * Save entity
     *
     * @param $entity
     * @return mixed
     */
    public function save($entity);

    /**
     * Remove entity
     *
     * @param $entity
     * @return void
     */
    public function remove($entity);
}