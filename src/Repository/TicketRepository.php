<?php

namespace App\Repository;

use App\Entity\Flight;
use App\Entity\Ticket;
use App\Entity\TicketFlight;
use App\Traits\TransferTrait;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends BaseRepository
{
    const TICKET_ALIAS = 'tk';
    const FLIGHT_ALIAS = 'f';
    const TICKET_FLIGHT_ALIAS = 'tkf';
    const ATTRIBUTE_ARR = [
        'id' => self::TICKET_ALIAS,
        'passenger' => self::TICKET_ALIAS,
        'discount' => self::TICKET_ALIAS,
        'seatType' => self::TICKET_ALIAS,
        'totalPrice' => self::TICKET_ALIAS,
        'createAt' => self::TICKET_ALIAS,
        'ticketOwner' => self::TICKET_ALIAS,
        'cancelAt' => self::TICKET_ALIAS,
    ];

    use TransferTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }


    public function getAll($param)
    {
        $ticket = $this->createQueryBuilder(static::TICKET_ALIAS);
        $ticket =  $this->join($ticket);
        $ticket = $this->addWhere($ticket, $param);
        $ticket = $this->addOrder($ticket);
        $query = $ticket->getQuery();

        return $query->execute();
    }

    public function create(Ticket $entity, bool $flush = false): Ticket
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
        return $entity;
    }

    public function update(Ticket $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    private function join($ticket)
    {
        $ticket->join(TicketFlight::class, self::TICKET_FLIGHT_ALIAS, Join::WITH, self::TICKET_ALIAS . '.id =' . self::TICKET_FLIGHT_ALIAS . '.ticket');
        $ticket->join(Flight::class, self::FLIGHT_ALIAS, Join::WITH, self::FLIGHT_ALIAS . '.id =' . self::TICKET_FLIGHT_ALIAS . '.flight');

        return $ticket;
    }

    private function addWhere($ticket, $param)
    {
        $this->andCustomFilter($ticket, self::TICKET_ALIAS, 'passenger', '=', $param['passenger']);
        if($param['effectiveness']){
            $this->andCustomFilter($ticket, self::FLIGHT_ALIAS, 'startTime', '>', $param['now']);
            $ticket->where(self::TICKET_ALIAS . '.cancelAt IS NULL');

        }else{
            $this->andCustomFilter($ticket, self::FLIGHT_ALIAS, 'startTime', '<=', $param['now']);
            $ticket->where(self::TICKET_ALIAS . '.cancelAt IS NOT NULL');
        }


        return $ticket;
    }

    private function addOrder($ticket)
    {
        $ticket->orderBy(self::TICKET_ALIAS . '.createdAt', 'ASC');

        return $ticket;
    }
}
