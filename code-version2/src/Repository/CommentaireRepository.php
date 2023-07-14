<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaire>
 *
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    public function save(Commentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Commentaire[] Returns an array of Commentaire objects
    */
   public function findByEmail($email): array{
       return $this->createQueryBuilder('c')
           ->andWhere('c.email = :email')
           ->setParameter('email', $email)
           ->orderBy('c.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

   /**
    * @return Commentaire Returns an array of Commentaire objects
    */
    public function findOneById($id): ?Commentaire{
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)            
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

   /**
    * @return Commentaire[] Returns an array of Commentaire objects
    */
    public function findAll(): array{
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Commentaire
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
