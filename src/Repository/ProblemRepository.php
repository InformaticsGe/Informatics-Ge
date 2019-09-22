<?php

namespace App\Repository;

use App\Entity\Problem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Problem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Problem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Problem[]    findAll()
 * @method Problem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Problem::class);
    }

    /**
     * Get only visible problems for listing page.
     *
     * @return Problem[]
     */
    public function findVisibleForListing()
    {
        return $this->createQueryBuilder('p')
            ->select(['p.id', 'p.title', 'p.tags', 'p.sourceTitle', 'p.sourceUrl'])
            ->andWhere('p.visible = :visible')
            ->setParameter('visible', true)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Problem[] Returns an array of Problem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Problem
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
