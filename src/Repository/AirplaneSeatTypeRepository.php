<?php

namespace App\Repository;

use App\Entity\AirplaneSeatType;
use App\Entity\SeatType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AirplaneSeatType>
 *
 * @method AirplaneSeatType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirplaneSeatType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirplaneSeatType[]    findAll()
 * @method AirplaneSeatType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirplaneSeatTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AirplaneSeatType::class);
    }

    public function add(AirplaneSeatType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AirplaneSeatType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function getSeatType($airplaneId, $seatTypeId): ?AirplaneSeatType
    {
//        dd($seatTypeId);
        return $this->createQueryBuilder('a')
            ->join(SeatType::class, 'st', Join::WITH, 'a.seatType=st.id')
            ->andWhere('a.airplane = :airplane')
            ->setParameter('airplane', $airplaneId)
            ->andWhere('st.name = :seatType')
            ->setParameter('seatType', $seatTypeId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

