<?php

namespace App\Repository;

use App\Entity\Discount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class DashboardRepository extends ServiceEntityRepository
{
    const TICKET_ALIAS = 'tk';
    private Connection $conn;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Discount::class);
        $this->conn = $this->getEntityManager()->getConnection();
    }


    public function getAnalyzeOfRoute()
    {
        $sql = "
        select concat(f.arrival,'-',f.departure) as journey, count(f.code) as number, 
        f.arrival, f.departure
        from ticket as tk
        join ticket_flight as tkf
        on tkf.ticket_id = tk .id 
        join flight as f
        on tkf.flight_id = f.id
        join airport as apr
        on f.arrival = apr.iata
        
        GROUP BY journey
        ";
        $stmt = $this->conn->prepare($sql);

        return $stmt->executeQuery()->fetchAllAssociative();
    }

    public function getAnalyzeOfAirline()
    {
        $sql = "select count(tk.id) as number, (al.name) as name
        from ticket as tk
        join ticket_flight as tkf
        on tkf.ticket_id = tk .id 
        join flight as f
        on tkf.flight_id = f.id
        join airplane as ap
        on f.airplane_id = ap.id
        join airline as al 
        on ap.airline_id = al.id
        
        GROUP BY al.name
        ";
        $stmt = $this->conn->prepare($sql);

        return $stmt->executeQuery()->fetchAllAssociative();
    }

}
