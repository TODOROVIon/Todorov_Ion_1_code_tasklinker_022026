<?php

namespace App\Repository;

use App\Entity\Tache;
use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tache>
 */
class TacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tache::class);
    }

       /**
        * @return Tache[] Returns an array of Tache objects
        */
       public function findByProjectWithRelations(Project $projet): array
       {
           return $this->createQueryBuilder('t')
                ->leftJoin('t.idStatus', 's')
                ->addSelect('s')
                ->leftJoin('t.idUser', 'u')
                ->addSelect('u')
                ->andWhere('t.idProject = :projet')
                ->setParameter('projet', $projet)
                ->orderBy('t.id', 'ASC')
                ->getQuery()
                ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?Tache
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
