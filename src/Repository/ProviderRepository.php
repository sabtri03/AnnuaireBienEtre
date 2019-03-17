<?php

namespace App\Repository;

use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Provider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provider[]    findAll()
 * @method Provider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Provider::class);
    }

    // /**
    //  * @return Provider[] Returns an array of Provider objects
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
    public function findOneBySomeField($value): ?Provider
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findByNomLocalityService($search): array
    {
        $qb = $this->createQueryBuilder('s');
        //$qb->addCriteria($qb);
        /*$qb->andWhere(
            $qb->expr()->like( 's.name', ':name' )
        );
        $qb->setParameter('name',"%".$search."%" );
*/
        //dump($search['selection']); die();
        if($search['selection'] == 1){
            $qb->andWhere('s.name LIKE :name');
            $qb->setParameter('name','%'.$search['search'].'%');
        }
        if($search['selection'] == 3){
            $qb->leftJoin('s.category','category');
            $qb->addSelect('category');
            $qb->andWhere('category.name LIKE :service');
            $qb->setParameter('service', '%'.$search['search'].'%');
        }
        if($search['selection'] == 2){
            $qb->leftJoin('s.adresseLocality','adresse');
            $qb->addSelect('adresse');
            $qb->andWhere('adresse.locality LIKE :locality');
            $qb->setParameter('locality', '%'.$search['search'].'%');
        }

        $query = $qb->getQuery();
        //$results = $query->getResult();
        return $query->execute();
    }



}
