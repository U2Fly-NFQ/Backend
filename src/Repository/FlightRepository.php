<?php

namespace App\Repository;

use App\Constant\MomentConstant;
use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\FlightSeatType;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Request\ListFlightRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
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
    const FLIGHT_SEAT_TYPE_ALIAS = 'fst';
    const ATTRIBUTE_ARR = [
        'icao' => self::AIRLINE_ALIAS,
        'arrival' => self::FLIGHT_ALIAS,
        'departure' => self::FLIGHT_ALIAS,
        'seatType' => self::FLIGHT_SEAT_TYPE_ALIAS,
        'price' => self::FLIGHT_SEAT_TYPE_ALIAS,
        'duration' => self::FLIGHT_ALIAS,
    ];

    private QueryBuilder $flight;
    private QueryBuilder $oneWayFlight;
    private QueryBuilder $roundTripFlight;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
        $this->flight = $this->createQueryBuilder(self::FLIGHT_ALIAS);
        $this->oneWayFlight = $this->createQueryBuilder(self::FLIGHT_ALIAS);
        $this->roundTripFlight = $this->createQueryBuilder(self::FLIGHT_ALIAS);
        $this->join([$this->oneWayFlight, $this->roundTripFlight]);
    }

    public function oneWayPagination(array $listFlightRequest)
    {
        return $this->paginationHandle($this->oneWayFlight, $listFlightRequest);
    }

    public function roundTripPagination(array $listFlightRequest)
    {
        return $this->paginationHandle($this->roundTripFlight, $listFlightRequest);
    }

    public function paginationHandle(QueryBuilder $flight, array $listFlightRequest)
    {
        $flights = $this->getAll($flight, $listFlightRequest);
        return [
            'page' => $listFlightRequest['pagination']['page'],
            'offset' => $listFlightRequest['pagination']['offset'],
            'total' => $this->countRecord($flights)
        ];
    }

    public function getAll(QueryBuilder $flight, array $listFlightRequest)
    {
        $this->addFilter($flight, $listFlightRequest);
        $this->addOrder($flight, $listFlightRequest);
        $result = $flight->getQuery()->getResult();
        return $result;
    }

    private function addFilter(QueryBuilder $flight, $listFlightRequest)
    {
        $this->andFilter($flight, self::FLIGHT_ALIAS, 'arrival', $listFlightRequest['arrival']);
        $this->andFilter($flight, self::FLIGHT_ALIAS, 'departure', $listFlightRequest['departure']);
        $this->andFilter($flight, self::SEAT_TYPE_ALIAS, 'name', $listFlightRequest['seatType']);
        $this->andFilter($flight, self::FLIGHT_ALIAS, 'startDate', $listFlightRequest['startDate']);

        $this->findMultipleAirline($flight, $listFlightRequest);
        $this->findByMoment($flight, $listFlightRequest);

        $this->andCustomFilter($flight, self::FLIGHT_SEAT_TYPE_ALIAS, 'price', '>=', $listFlightRequest['minPrice']);
        $this->andCustomFilter($flight, self::FLIGHT_SEAT_TYPE_ALIAS, 'price', '<=', $listFlightRequest['maxPrice']);
        $this->andCustomFilter($flight, self::FLIGHT_SEAT_TYPE_ALIAS, 'seatAvailable', '>=', $listFlightRequest['seatNumber']);
    }

    private function findMultipleAirline(QueryBuilder $flight, $listFlightRequest)
    {
        $airlines = $this->getAirlineArray($listFlightRequest['airline']);
        if ($airlines) {
            $flight->andWhere("al.icao IN (:airlines)")->setParameter("airlines", $airlines);
        }
    }

    private function findByMoment(QueryBuilder $flight, $listFlightRequest)
    {
        if ($listFlightRequest['startTime']) {
            $moment = MomentConstant::MOMENT[$listFlightRequest['startTime']];
            $this->andCustomFilter($flight, self::FLIGHT_ALIAS, 'startTime', '>=', $moment['startTime']);
            $this->andCustomFilter($flight, self::FLIGHT_ALIAS, 'startTime', '<=', $moment['endTime']);
        }
    }

    private function getAirlineArray($airlines)
    {
        if ($airlines == null) {
            return null;
        }

        return explode(',', $airlines);
    }

    private function addOrder(QueryBuilder $flight, $listFlightRequest)
    {
        if (!empty($listFlightRequest['order'])) {
            $this->sort($flight, self::ATTRIBUTE_ARR, $listFlightRequest['order']);
        }
    }


    private function join(array $flights)
    {
        foreach ($flights as $flight) {
            $flight->join(Airplane::class, 'ap', Join::WITH, 'f.airplane=ap.id');
            $flight->join(Airline::class, 'al', Join::WITH, 'ap.airline=al.id');
            $flight->join(FlightSeatType::class, 'fst', Join::WITH, 'fst.flight=f.id');
            $flight->join(SeatType::class, 'st', Join::WITH, 'st.id=fst.seatType');
        }
    }

    public function oneWayLimit($limit, $offset)
    {
        $this->oneWayFlight->setFirstResult(($limit - 1) * $offset);
        $this->oneWayFlight->setMaxResults($offset);

        return $this->oneWayFlight->getQuery()->getResult();
    }

    public function roundTripLimit($limit, $offset)
    {
        $this->roundTripFlight->setFirstResult(($limit - 1) * $offset);
        $this->roundTripFlight->setMaxResults($offset);

        return $this->roundTripFlight->getQuery()->getResult();
    }


    public function countRecord(array $flight)
    {
        return count($flight);
    }
}
