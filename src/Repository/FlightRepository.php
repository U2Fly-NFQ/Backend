<?php

namespace App\Repository;

use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\Flight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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
    const FLIGHT_ALIAS = 'f';
    const AIRLINE_ALIAS = 'al';
    const AIRPLANE_ALIAS = 'ap';
    const ATTRIBUTE_ARR = [
        'icao' => self::AIRLINE_ALIAS,
        'arrival' => self::FLIGHT_ALIAS,
        'departure' => self::FLIGHT_ALIAS,
    ];

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    public function filter(array $listFlightRequest): array
    {
        $qb = $this->createQueryBuilder(self::FLIGHT_ALIAS);
        $qb = $this->join($qb);
        $listFlightRequest = $this->checkFilterByDate($listFlightRequest);
        $qb = $this->addWhere($listFlightRequest['criteria'], $qb);
        if (!empty($listFlightRequest['like'])) {
            $qb = $this->addLike($listFlightRequest, $qb);
        }
        $qb->addOrderBy('f.id', 'asc');
        $total = $this->countRecord($qb);
        $qb = $this->pagination($qb, $listFlightRequest['pagination']['page'], $listFlightRequest['pagination']['offset']);
        $query = $qb->getQuery();
        $data = $query->getResult();

        return ['data' => $data,
            'pagination' => [
                'current_page' => $listFlightRequest['pagination']['page'],
                'total' => $total,
            ]
        ];
    }

    private function pagination($qb, $limit, $offset)
    {
        $qb->setFirstResult(($limit - 1) * $offset);
        $qb->setMaxResults($offset);

        return $qb;
    }

    private function checkFilterByDate($listFlightRequest)
    {
        if (!empty($listFlightRequest['criteria']['startTime'])) {
            $listFlightRequest['like']['startTime'] = $listFlightRequest['criteria']['startTime'];
            unset($listFlightRequest['criteria']['startTime']);
        }

        return $listFlightRequest;
    }

    private function join($qb)
    {
        $qb->join(Airplane::class, self::AIRPLANE_ALIAS, Join::WITH, self::FLIGHT_ALIAS . '.airplane =' . self::AIRPLANE_ALIAS . '.id');
        $qb->join(Airline::class, self::AIRLINE_ALIAS, Join::WITH, self::AIRPLANE_ALIAS . '.airline=' . self::AIRLINE_ALIAS . '.id');

        return $qb;
    }

    private function countRecord($qb)
    {
        $query = $qb->getQuery();
        $data = $query->getResult();

        return count($data);
    }

    private function addWhere($listFlightRequest, $qb)
    {
        foreach ($listFlightRequest as $key => $value) {
            if ($value != null) {
                $qb->andWhere(self::ATTRIBUTE_ARR[$key] . '.' . $key . ' = ' . '\'' . $value . '\'');
            }
        }

        return $qb;
    }

    private function addLike($listFlightRequest, $qb)
    {
        foreach ($listFlightRequest['like'] as $key => $value) {
            if ($value != null) {
                $qb->andWhere(self::FLIGHT_ALIAS . '.' . $key . ' LIKE ' . '\'' . $value . '%\'');
            }
        }

        return $qb;
    }

    private function sort($listCarRequest, $qb)
    {
        if (!isset($listCarRequest['filterBy'])) {
            $query = $qb->getQuery();
            return $query->getResult();
        }
        foreach ($listCarRequest['filterBy'] as $key => $value) {
            $qb->addOrderBy(self::FLIGHT_ALIAS . '.' . $key, $value);
        }
    }
}
