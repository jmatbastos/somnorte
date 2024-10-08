<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function get_users()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT id, name, nif, email, roles FROM `users` ";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    }





    public function delete_user($user_id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql="DELETE FROM users WHERE id='$user_id'";
        $conn->executeQuery($sql);
    }

    public function get_actors()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT id, name FROM `users` WHERE roles ='[\"ROLE_ACTOR\"]'";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    }

    public function get_clients()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT id, name FROM `users` WHERE roles ='[\"ROLE_CLIENT\"]'";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
