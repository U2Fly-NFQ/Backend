<?php

namespace App\Repository;

use App\Entity\AbstractEntity;
use App\Entity\Ticket;
use App\Entity\TicketsStatistic;
use App\Traits\DateTimeTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<TicketsStatistic>
 *
 * @method TicketsStatistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketsStatistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketsStatistic[]    findAll()
 * @method TicketsStatistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketsStatisticRepository extends BaseRepository
{
    private QueryBuilder $ticketStatistic;
    use DateTimeTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TicketsStatistic::class);
        $this->ticketStatistic = $this->createQueryBuilder('tkst');
    }

    public function addTicketsStatistic(AbstractEntity $entity, bool $flush = false): AbstractEntity
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
        return $entity;
    }

    public function updateCancelStatistic(string $id, int $cancelNumber, $cancelDate)
    {
        $query = $this->ticketStatistic
            ->update()
            ->set('tkst.cancel', ':cancel')
            ->setParameter('cancel', $cancelNumber + 1)
            ->where('tkst.date=' . '\'' . $this->dateTimeToDate($cancelDate) . '\'');

        return $query->getQuery()->execute();
    }

    public function updateSuccessStatistic(string $id, int $successNumber, $cancelDate)
    {
        $query = $this->ticketStatistic
            ->update()
            ->set('tkst.success', ':success')
            ->setParameter('success', $successNumber + 1)
            ->where('tkst.date=' . '\'' . $this->dateTimeToDate($cancelDate) . '\'');

        return $query->getQuery()->execute();
    }





}
