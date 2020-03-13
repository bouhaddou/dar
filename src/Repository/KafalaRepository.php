<?php

namespace App\Repository;

use App\Entity\Kafala;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Kafala|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kafala|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kafala[]    findAll()
 * @method Kafala[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KafalaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kafala::class);
    }

    // /**
    //  * @return Kafala[] Returns an array of Kafala objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kafala
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
