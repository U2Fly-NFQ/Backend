<?php

namespace App\Repository;

use App\Entity\FlightSeatType;
use App\Entity\SeatType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @method FlightSeatType|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlightSeatType|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlightSeatType[]    findAll()
 * @method FlightSeatType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightSeatTypeRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlightSeatType::class);
    }


    public function getSeatType($flightId, $seatTypeId): FlightSeatType
    {
        return $this->createQueryBuilder('fst')
            ->join(SeatType::class, 'st', Join::WITH, 'fst.seatType=st.id')
            ->andWhere('fst.flight = :flightId')
            ->setParameter('flightId', $flightId)
            ->andWhere('st.name = :seatType')
            ->setParameter('seatType', $seatTypeId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
