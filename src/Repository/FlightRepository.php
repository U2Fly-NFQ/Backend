<?php

namespace App\Repository;

use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\AirplaneSeatType;
use App\Entity\Airport;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Request\ListFlightRequest;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
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
        'seatType' => self::AIRPLANE_SEAT_TYPE_ALIAS,
        'price' => self::AIRPLANE_SEAT_TYPE_ALIAS,
        'duration'=>self::FLIGHT_ALIAS,
    ];

    private QueryBuilder $flight;
    private QueryBuilder $flightWithoutPagination;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
        $this->flight = $this->createQueryBuilder(self::FLIGHT_ALIAS);
        $this->flightWithoutPagination = $this->createQueryBuilder(self::FLIGHT_ALIAS);
    }

    public function getAll(array $listFlightRequest)
    {

        $this->join();
        $this->filter($this->flight, self::FLIGHT_ALIAS, 'arrival', $listFlightRequest['criteria']['arrival']);
        $this->andFilter($this->flight, self::FLIGHT_ALIAS, 'departure', $listFlightRequest['criteria']['departure']);
        $this->andFilter($this->flight, self::AIRLINE_ALIAS, 'icao', $listFlightRequest['criteria']['airline']);
        $this->andFilter($this->flight, self::SEAT_TYPE_ALIAS, 'name', $listFlightRequest['criteria']['seatType']);

        $this->andCustomFilter($this->flight, self::AIRPLANE_SEAT_TYPE_ALIAS, 'price', '>=', $listFlightRequest['criteria']['minPrice']);
        $this->andCustomFilter($this->flight, self::AIRPLANE_SEAT_TYPE_ALIAS, 'price', '<=', $listFlightRequest['criteria']['maxPrice']);
        $this->andCustomFilter($this->flight, self::AIRPLANE_SEAT_TYPE_ALIAS, 'seatAvailable', '>=', $listFlightRequest['criteria']['seatNumber']);

        $this->andLike($this->flight, self::FLIGHT_ALIAS, 'startTime', $listFlightRequest['criteria']['startTime']);
        if (!empty($listFlightRequest['order'])) {
            $this->sort($this->flight, self::ATTRIBUTE_ARR, $listFlightRequest['order']);
        }
        $result = $this->flight->getQuery()->getResult();
        return $result;
    }


    private function join()
    {
        $this->flight->join(Airplane::class, 'ap', Join::WITH, 'f.airplane=ap.id');
        $this->flight->join(Airline::class, 'al', Join::WITH, 'ap.airline=al.id');
        $this->flight->join(AirplaneSeatType::class, 'ast', Join::WITH, 'ast.airplane=ap.id');
        $this->flight->join(SeatType::class, 'st', Join::WITH, 'st.id=ast.seatType');

    }

    public function limit($limit, $offset)
    {

        $this->flight->setFirstResult(($limit - 1) * $offset);
        $this->flight->setMaxResults($offset);
        return $this->flight->getQuery()->getResult();
    }

    public function pagination(array $listFlightRequest)
    {
        $flights = $this->getAll($listFlightRequest);
        return [
            'page' => $listFlightRequest['pagination']['page'],
            'offset' => $listFlightRequest['pagination']['offset'],
            'total' => $this->countRecord($flights)
        ];
    }

    public function countRecord(array $flight)
    {
        return count($flight);

    }


}
