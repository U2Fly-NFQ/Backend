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
        'seatType' => self::AIRPLANE_SEAT_TYPE_ALIAS
    ];

    private QueryBuilder $flight;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    public function getAll(array $listFlightRequest)
    {
        $this->flight = $this->createQueryBuilder(self::FLIGHT_ALIAS);
        $this->join();

        $this->filter($this->flight, self::FLIGHT_ALIAS, 'arrival', $listFlightRequest['criteria']['arrival']);
        $this->andFilter($this->flight, self::FLIGHT_ALIAS, 'departure', $listFlightRequest['criteria']['departure']);
        $this->andFilter($this->flight, self::AIRLINE_ALIAS, 'icao', $listFlightRequest['criteria']['airline']);
        $this->andFilter($this->flight, self::SEAT_TYPE_ALIAS, 'name', $listFlightRequest['criteria']['seatType']);

        $this->andCustomFilter($this->flight, self::AIRPLANE_SEAT_TYPE_ALIAS, 'price', '>=', $listFlightRequest['criteria']['minPrice']);
        $this->andCustomFilter($this->flight, self::AIRPLANE_SEAT_TYPE_ALIAS, 'price', '<=', $listFlightRequest['criteria']['maxPrice']);

        $this->andLike($this->flight, self::FLIGHT_ALIAS, 'startTime', $listFlightRequest['criteria']['startTime']);

        $this->sort($this->flight, self::ATTRIBUTE_ARR, $listFlightRequest['order']);

        $this->limit($listFlightRequest['pagination']['page'], $listFlightRequest['pagination']['offset']);
        dd($this->flight->getQuery());
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

    private function limit($limit, $offset)
    {
        $this->flight->setFirstResult(($limit - 1) * $offset);
        $this->flight->setMaxResults($offset);
    }

    public function pagination(ListFlightRequest $listFlightRequest)
    {
        return [
            'page' => $listFlightRequest->getPage(),
            'offset' => $listFlightRequest->getOffset(),
            'total' => $this->countRecord()
        ];
    }

    public function countRecord()
    {
        $query = $this->flight->getQuery();
        $data = $query->getResult();

        return count($data);
    }


}
