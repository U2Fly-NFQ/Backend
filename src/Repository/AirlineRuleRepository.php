<?php

namespace App\Repository;

use App\Entity\AirlineRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @method AirlineRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirlineRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirlineRule[]    findAll()
 * @method AirlineRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirlineRuleRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AirlineRule::class);
    }
}
