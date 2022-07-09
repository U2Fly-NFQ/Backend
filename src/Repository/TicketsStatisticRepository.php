<?php

namespace App\Repository;

use App\Entity\TicketsStatistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TicketsStatistic>
 *
 * @method TicketsStatistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketsStatistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketsStatistic[]    findAll()
 * @method TicketsStatistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketsStatisticRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TicketsStatistic::class);
    }
}
