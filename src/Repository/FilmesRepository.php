<?php

namespace App\Repository;

use App\Entity\Filmes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Filmes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filmes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filmes[]    findAll()
 * @method Filmes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Filmes::class);
    }

//    /**
//     * @return Filmes[] Returns an array of Filmes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Filmes
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
