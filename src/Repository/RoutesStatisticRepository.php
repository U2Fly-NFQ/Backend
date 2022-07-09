<?php

namespace App\Repository;

use App\Entity\RoutesStatistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoutesStatistic>
 *
 * @method RoutesStatistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoutesStatistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoutesStatistic[]    findAll()
 * @method RoutesStatistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoutesStatisticRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoutesStatistic::class);
    }
}
