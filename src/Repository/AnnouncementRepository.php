<?php

namespace App\Repository;

use App\Entity\Announcement;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Announcement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announcement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announcement[]    findAll()
 * @method Announcement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcement::class);
    }


    public function getAll(){
        return  $this   ->createQueryBuilder('p')
            ->select('p')
            ->getQuery()
            ;
    }

    public function getAllByCategory(Category $category){
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.category', 'cat')
            ->where('cat.id = :id')
            ->setParameter('id', $category->getId())
            ->orderBy('a.createdAt', 'DESC')
        ;
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return Announcement[] Returns an array of Announcement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Announcement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
