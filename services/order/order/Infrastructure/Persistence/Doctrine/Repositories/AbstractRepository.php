<?php

namespace GkOrder\Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;
use OneMustCode\Paginator\Paginator;
use OneMustCode\Paginator\PaginatorInterface;
use OneMustCode\Query\Builders\DoctrineQueryBuilder;
use OneMustCode\Query\Query;

abstract class AbstractRepository extends EntityRepository
{
    use PaginatesFromParams;

    /**
     * The filters to accept
     *
     * @var array
     */
    protected $acceptedFilters = [];

    /**
     * The sortings to accept
     *
     * @var array
     */
    protected $acceptedSortings = [];

    /**
     * @inheritdoc
     */
    public function findOne($id)
    {
        return $this->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findOneByQuery(Query $query)
    {
        $queryBuilder = $this->buildQueryBuilderFromQuery(null, $query);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @inheritdoc
     */
    public function findAllByQuery(Query $query): array
    {
        $queryBuilder = $this->buildQueryBuilderFromQuery(null, $query);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @inheritdoc
     */
    public function findPaginatedByQuery(Query $query): PaginatorInterface
    {
        $queryBuilder = $this->buildQueryBuilderFromQuery(null, $query);

        $results = $this->paginate($queryBuilder->getQuery(), $query->getPaging()->getPerPage(), $query->getPaging()->getPage());

        return new Paginator(
            iterator_to_array($results),
            $results->total(),
            $query->getPaging()->getPage(),
            $query->getPaging()->getPerPage()
        );
    }

    /**
     * @param $entity
     * @return object
     */
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * @param $entity
     * @return void
     */
    public function remove($entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    /**
     * @param QueryBuilder|null $queryBuilder
     * @param Query $query
     * @return QueryBuilder
     */
    protected function buildQueryBuilderFromQuery(QueryBuilder $queryBuilder = null, Query $query)
    {
        if ($queryBuilder == null) {
            $queryBuilder = $this->createQueryBuilder('e');
        }

        return (new DoctrineQueryBuilder())->build($query, $queryBuilder, $this->acceptedFilters, $this->acceptedSortings);
    }
}