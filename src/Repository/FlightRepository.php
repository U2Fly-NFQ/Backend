<?php

namespace App\Repository;

use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\Flight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Flight>
 *
 * @method Flight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flight[]    findAll()
 * @method Flight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    public function filter(array $listFlightRequest): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb->join(Airplane::class, 'ap', \Doctrine\ORM\Query\Expr\Join::WITH, 'p.airplane = ap.id');
        $qb->join(Airline::class, 'al', \Doctrine\ORM\Query\Expr\Join::WITH, 'ap.airline=al.id');
        if (!empty($listFlightRequest['criteria']['startTime'])) {
            $listFlightRequest['like']['startTime'] = $listFlightRequest['criteria']['startTime'];
            unset($listFlightRequest['criteria']['startTime']);
        }
        foreach ($listFlightRequest['criteria'] as $key => $value) {
            if ($value != null) {
                $qb->andWhere('p.' . $key . ' = ' . '\'' . $value . '\'');
            }
        }
        foreach ($listFlightRequest['like'] as $key => $value) {
            if ($value != null) {
                $qb->andWhere('p.' . $key . ' LIKE ' . '\'' . $value . '%\'');
            }
        }

//        if (!isset($listCarRequest['filterBy'])) {
//            $query = $qb->getQuery();
//            return $query->getResult();
//        }
//        foreach ($listCarRequest['filterBy'] as $key => $value) {
//            $qb->addOrderBy('p.' . $key, $value);
//        }

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
