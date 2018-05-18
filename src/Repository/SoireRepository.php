<?php

namespace App\Repository;

use App\Entity\Soire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Soire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soire[]    findAll()
 * @method Soire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Soire::class);
    }

//    /**
//     * @return Soire[] Returns an array of Soire objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Soire
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
