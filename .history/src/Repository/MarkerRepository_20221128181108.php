<?php

namespace App\Repository;

use App\Entity\Marker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Marker>
 *
 * @method Marker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marker[]    findAll()
 * @method Marker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marker::class);
    }

    public function filterCategory($category, $page = 1, $elements_per_page = 5)
    {
        $query = $this->createQueryBuilder('m')
            ->innerJoin('m.category', 'c')
            ->where('c.name = :namecategory')
            ->setParameter('namecategory', $category)
            ->getQuery();

         return $this->pagination($query, $page, $elements_per_page);
    }
    public function filterName($name,$dql,$page = 1, $elements_per_page = 5)
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.name LIKE  :name')
            ->setParameter('name', "%$name%")
            ->getQuery();
            return $this->pagination($query, $page, $elements_per_page);
        
    }
    public function  filterAll($page = 1, $elements_per_page = 5){
        
    }

    public function save(Marker $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Marker $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function pagination($dql,$page = 1, $elements_per_page = 5){
        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($dql);
        $paginator->getQuery()
            ->setFirstResult($elements_per_page * ($page - 1)) // Offset
            ->setMaxResults($elements_per_page); // Limit
        return $paginator;
    }

//    /**
//     * @return Marker[] Returns an array of Marker objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Marker
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
