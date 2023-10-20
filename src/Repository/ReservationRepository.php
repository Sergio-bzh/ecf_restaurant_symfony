<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use App\DQL\DatetimeFunction;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function findCreneauFields($day, $serviceType, EntityManager $entityManager): array
    {
        $query = $entityManager->createQuery('SELECT 
        Hour(r.meal_time) AS heure, 
        Floor(minute(r.meal_time) / 15) AS quart_heure, 
        SUM(r.guest_number) AS places_reservees
        FROM App\Entity\Reservation r
        JOIN App\Entity\Schedule s WHERE s.day_of_week = WEEKDAY(r.reservation_date) AND r.meal_time BETWEEN s.service_start AND s.service_end
        AND s.day_of_week = WEEKDAY(?1) AND s.service_type = ?2 AND (?1)=(r.reservation_date)
        GROUP BY heure, quart_heure');
        $query->setParameter(1, $day);
        $query->setParameter(2, $serviceType);
        return $query->getResult();
    }

    //    /**
    //     * @return Reservation[] Returns an array of Reservation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Reservation
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
