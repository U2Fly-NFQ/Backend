<?php

namespace App\Repository;

use App\Entity\Airport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @method Airport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airport[]    findAll()
 * @method Airport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirportRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airport::class);
    }


    public function findByIATA($iata): ?Airport
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.iata = :val')
            ->setParameter('val', $iata)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

