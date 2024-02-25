<?php

namespace App\Repository;

use App\Entity\ImageOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageOffre>
 *
 * @method ImageOffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageOffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageOffre[]    findAll()
 * @method ImageOffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageOffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageOffre::class);
    }

    //    /**
    //     * @return ImageOffre[] Returns an array of ImageOffre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ImageOffre
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
