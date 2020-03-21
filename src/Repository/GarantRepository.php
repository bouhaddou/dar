<?php

namespace App\Repository;

use App\Entity\Garant;
use App\Entity\Orphelin;


use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Garant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Garant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Garant[]    findAll()
 * @method Garant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GarantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Garant::class);
    }

    // /**
    //  * @return Garant[] Returns an array of Garant objects
    //  */
    
    public function findGaranybyOrpelin(Orphelin $orphelin)
    {
        return $this->createQueryBuilder('g')
            ->join('g.kafalas', 'k')
            ->andWhere('k.Orphelin = :val')
            ->setParameter('val', $orphelin)
            ->setMaxResults(300)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Garant
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
