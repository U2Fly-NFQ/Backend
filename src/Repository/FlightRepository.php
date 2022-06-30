<?php

namespace App\Repository;

use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\AirplaneSeatType;
use App\Entity\Airport;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Request\ListFlightRequest;
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
    const SEAT_TYPE_ALIAS = 'st';
    const AIRPLANE_SEAT_TYPE_ALIAS = 'ast';
    const ATTRIBUTE_ARR = [
        'icao' => self::AIRLINE_ALIAS,
        'arrival' => self::FLIGHT_ALIAS,
        'departure' => self::FLIGHT_ALIAS,
        'seatType' => self::AIRPLANE_SEAT_TYPE_ALIAS
    ];

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    public function getAll(ListFlightRequest $listFlightRequest)
    {
        $flight = $this->createQueryBuilder(self::FLIGHT_ALIAS);
        $this->join($flight);
        $flight = $this->filter($flight, self::FLIGHT_ALIAS, 'arrival', $listFlightRequest->getArrival());
        $flight = $this->andFilter($flight, self::FLIGHT_ALIAS, 'departure', $listFlightRequest->getDeparture());
        $flight = $this->andFilter($flight, self::AIRLINE_ALIAS, 'icao', $listFlightRequest->getAirline());
        $flight = $this->andFilter($flight, self::SEAT_TYPE_ALIAS, 'name', $listFlightRequest->getSeatType());
        $flight = $this->andLike($flight, self::FLIGHT_ALIAS, 'startTime', $listFlightRequest->getStartTime());
        $result = $flight->getQuery()->getResult();

        return $result;
    }


    private function join($qb)
    {
        $qb->join(Airplane::class, 'ap', Join::WITH, 'f.airplane=ap.id');
        $qb->join(Airline::class, 'al', Join::WITH, 'ap.airline=al.id');
        $qb->join(AirplaneSeatType::class, 'ast', Join::WITH, 'ast.airplane=ap.id');
        $qb->join(SeatType::class, 'st', Join::WITH, 'st.id=ast.seatType');

        return $qb;
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
