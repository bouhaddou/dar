<?php

namespace App\Repository;

use App\Entity\Kafala;
use App\Entity\Orphelin;



use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
    

    public function findKafalabyOrphelin(Orphelin $orphelin)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.Orphelin= :val')
            ->setParameter('val', $orphelin)
            ->setMaxResults(300)
            ->getQuery()
            ->getResult()
        ;
    }
    

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
