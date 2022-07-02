<?php

namespace App\Repository;

use App\Entity\AbstractEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class BaseRepository extends ServiceEntityRepository
{
    protected string $alias;

    public function __construct(ManagerRegistry $registry, string $entityClass = '', $alias = '')
    {
        parent::__construct($registry, $entityClass);
        $this->alias = $alias;
    }

    public function add(AbstractEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AbstractEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    protected function filter(QueryBuilder $query, string $alias, string $field, mixed $value): QueryBuilder
    {
        if (empty($value)) {
            return $query;
        }

        return $query->where($alias . ".$field = :$field")->setParameter($field, $value);
    }

    protected function andFilter(QueryBuilder $query, string $alias, string $field, mixed $value): QueryBuilder
    {
        if (empty($value)) {
            return $query;
        }

        return $query->andWhere($alias . ".$field = :$field")->setParameter($field, $value);
    }

    protected function andCustomFilter(QueryBuilder $query, string $alias, string $field, string $operator, mixed $value): QueryBuilder
    {
        if (empty($value)) {
            return $query;
        }

        return $query->andWhere("$alias.$field $operator $value");
    }


    protected function andLike(QueryBuilder $query, string $alias, string $field, mixed $value): QueryBuilder
    {
        if (empty($value)) {
            return $query;
        }

        return $query->andWhere($alias . '.' . $field . ' LIKE ' . '\'' . $value . '%\'');
    }

    protected function sort(QueryBuilder $query, array $alias, array $listCarRequest,)
    {
        if (empty($listCarRequest)) {
            return $query;
        }
        foreach ($listCarRequest as $key => $value) {
            $query->addOrderBy($alias . '.' . [$key] . '.' . $value);
        }
        return $query;
    }
}

