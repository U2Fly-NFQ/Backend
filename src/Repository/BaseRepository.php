<?php

namespace App\Repository;

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

    protected function filter(QueryBuilder $cars, string $field, mixed $value): QueryBuilder //$field = color, $value = black
    {
        if (empty($value)) {
            return $cars;
        }
        return $cars->where($this->alias . ".$field = :$field")->setParameter($field, $value);
    }

    protected function moreFilter(QueryBuilder $cars, string $field, mixed $value): QueryBuilder
    {
        if (empty($value)) {
            return $cars;
        }
        return $cars->andWhere($this->alias . ".$field = :$field")->setParameter($field, $value);
    }

}
