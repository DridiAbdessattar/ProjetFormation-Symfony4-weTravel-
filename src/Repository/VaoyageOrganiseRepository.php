<?php

namespace App\Repository;

use App\Entity\VaoyageOrganise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VaoyageOrganise|null find($id, $lockMode = null, $lockVersion = null)
 * @method VaoyageOrganise|null findOneBy(array $criteria, array $orderBy = null)
 * @method VaoyageOrganise[]    findAll()
 * @method VaoyageOrganise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VaoyageOrganiseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VaoyageOrganise::class);
    }

//    /**
//     * @return VaoyageOrganise[] Returns an array of VaoyageOrganise objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VaoyageOrganise
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
