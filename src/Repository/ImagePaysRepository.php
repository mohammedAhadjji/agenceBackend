<?php

namespace App\Repository;

use App\Entity\ImagePays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImagePays>
 *
 * @method ImagePays|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImagePays|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImagePays[]    findAll()
 * @method ImagePays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagePaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImagePays::class);
    }

    //    /**
    //     * @return ImagePays[] Returns an array of ImagePays objects
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

    //    public function findOneBySomeField($value): ?ImagePays
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
