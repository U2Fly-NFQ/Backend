<?php

namespace App\Repository;

use App\Entity\TicketFlight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @method TicketFlight|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketFlight|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketFlight[]    findAll()
 * @method TicketFlight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketFlightRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TicketFlight::class);
    }

}
