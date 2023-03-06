<?php

namespace App\Repository;

use App\Entity\VariantProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VariantProduit>
 *
 * @method VariantProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method VariantProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method VariantProduit[]    findAll()
 * @method VariantProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariantProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariantProduit::class);
    }

    public function save(VariantProduit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VariantProduit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBenny() 
    {
        return $this->createQueryBuilder('v')
            ->setMaxResults(10)
           ->getQuery()
           ->getResult();
    }

//    /**
//     * @return VariantProduit[] Returns an array of VariantProduit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VariantProduit
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
