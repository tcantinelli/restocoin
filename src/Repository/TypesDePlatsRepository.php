<?php

namespace App\Repository;

use App\Entity\TypesDePlats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypesDePlats|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypesDePlats|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypesDePlats[]    findAll()
 * @method TypesDePlats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypesDePlatsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypesDePlats::class);
    }

//    /**
//     * @return TypesDePlats[] Returns an array of TypesDePlats objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypesDePlats
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
