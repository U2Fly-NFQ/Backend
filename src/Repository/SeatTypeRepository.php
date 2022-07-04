<?php

namespace App\Repository;

use App\Entity\SeatType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @method SeatType|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeatType|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeatType[]    findAll()
 * @method SeatType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeatTypeRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeatType::class);
    }
}
