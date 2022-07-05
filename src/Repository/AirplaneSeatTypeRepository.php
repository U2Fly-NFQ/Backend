<?php

namespace App\Repository;

use App\Entity\AirplaneSeatType;
use App\Entity\SeatType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @method AirplaneSeatType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirplaneSeatType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirplaneSeatType[]    findAll()
 * @method AirplaneSeatType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirplaneSeatTypeRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AirplaneSeatType::class);
    }


    public function getSeatType($airplaneId, $seatTypeId): ?AirplaneSeatType
    {
        return $this->createQueryBuilder('ast')
            ->join(SeatType::class, 'st', Join::WITH, 'ast.seatType=st.id')
            ->andWhere('ast.airplane = :airplane')
            ->setParameter('airplane', $airplaneId)
            ->andWhere('st.name = :seatType')
            ->setParameter('seatType', $seatTypeId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
