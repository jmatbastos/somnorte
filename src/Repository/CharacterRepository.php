<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Character>
 */
class CharacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }


    public function insert_characters($contents)
    {
        $conn = $this->getEntityManager()->getConnection();

        $contents_array = explode(',', $contents);
        
        $sql = "INSERT INTO characters (series_id, episode_id, char_name, no_of_lines) VALUES ('$contents_array[0]','$contents_array[1]','$contents_array[2]','$contents_array[3]')";

        $conn->executeQuery($sql);

    }

    public function get_characters()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT DISTINCT char_name FROM `characters`";

        $resultSet = $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    }  
    public function get_actors()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT id, name FROM `users` WHERE roles ='[\"ACTOR\"]'";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 

    public function get_episodes()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT s.REF, c.episode_id, c.char_name, c.no_of_lines, u.name as actor_name FROM `users` as u RIGHT JOIN (characters as c INNER JOIN series AS s ON c.series_id=s.id)  ON c.actor_id=u.id";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 
    
    public function assign_actor($actor_id, $characters)
    {
        $conn = $this->getEntityManager()->getConnection();

        
        for($i=0; $i<count($characters); $i++)  {
            $sql = "UPDATE characters SET actor_id='$actor_id' WHERE char_name='$characters[$i]'";
            $conn->executeQuery($sql);
        }      

        



    }     
    
}
