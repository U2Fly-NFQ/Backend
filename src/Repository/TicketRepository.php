<?php

namespace App\Repository;

use App\Entity\Flight;
use App\Entity\Ticket;
use App\Request\TicketRequest;
use App\Traits\TransferTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Cache\ArrayResult;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ticket>
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

    use TransferTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }


    public function getAll($ticketRequest)
    {
        $ticket = $this->createQueryBuilder(static::TICKET_ALIAS);
        $ticket =  $this->join($ticket);
        $listTicketRequest = $this->objectToArray($ticketRequest);
        $this->addWhere($listTicketRequest, $ticket);

        $query = $ticket->getQuery();
        return $query->getResult();
    }

    private function join($ticket)
    {
        $ticket->join(Flight::class, self::FLIGHT_ALIAS, Join::WITH, self::TICKET_ALIAS . '.flight =' . self::FLIGHT_ALIAS . '.id');
        return $ticket;
    }

    private function addWhere($listTicketRequest, $ticket)
    {
        foreach ($listTicketRequest as $key => $value) {
            if ($value != null) {
                $ticket->andWhere(self::TICKET_ALIAS . '.' . $key . ' = ' . '\'' . $value . '\'');
            }
        }
    }
}
