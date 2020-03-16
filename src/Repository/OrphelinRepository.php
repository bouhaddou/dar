<?php

namespace App\Repository;

use App\Entity\Orphelin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Orphelin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orphelin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orphelin[]    findAll()
 * @method Orphelin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrphelinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orphelin::class);
    }

    // /**
    //  * @return Orphelin[] Returns an array of Orphelin objects
    //  */
    
    public function findByStatus($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.status = :val')
            ->setParameter('val', false)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults($value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByStatus2($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.status = :val')
            ->setParameter('val', true)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults($value)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Orphelin
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
