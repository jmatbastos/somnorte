<?php

namespace App\Repository;

use App\Entity\Personas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personas>
 */
class PersonasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personas::class);
    }


    public function insert_personas($contents)
    {
    
        $contents_array = explode(',', $contents);   

        $conn = $this->getEntityManager()->getConnection();


        // check if persona already exists in database; if not add
           
        
        $sql="INSERT IGNORE INTO personas (series_REF, name) VALUES ('$contents_array[0]','$contents_array[2]')";
        $conn->executeQuery($sql);

    }

    /*
    public function get_personas($series_REF)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT id, name FROM `personas` WHERE series_REF='$series_REF'";

        $resultSet = $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 
    */

    public function get_personas($series_REF)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT p.id, p.name, u.name as actor FROM personas as p LEFT JOIN (persona_has_actors as pa INNER JOIN `users` as u ON pa.actor_id=u.id) ON p.id=pa.persona_id WHERE p.series_REF='$series_REF'";

        $resultSet = $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 

    

    public function assign_actor($actors, $characters)
    {
        $conn = $this->getEntityManager()->getConnection();

        
        for($i=0; $i<count($characters); $i++)  {
            $sql="DELETE FROM persona_has_actors WHERE persona_id='$characters[$i]'";
            $conn->executeQuery($sql);
            for($j=0; $j<count($actors); $j++)  {
                $sql = "INSERT INTO persona_has_actors (persona_id, actor_id) VALUES('$characters[$i]','$actors[$j]')";
                $conn->executeQuery($sql);                
            }
        }      

        



    } 

    public function get_episodes($series_REF)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql ="SELECT e.series_REF as REF, e.episode as episode_id, p.name as char_name, p.id as char_id, u.name as actor_name, n.no_of_lines, n.id 
        FROM persona_has_actors as pa 
        INNER JOIN users as u 
        RIGHT JOIN (personas as p INNER JOIN (episodes as e, no_of_lines as n) ON (n.episode_id=e.id AND n.persona_id=p.id)) 
        ON (pa.persona_id=p.id AND pa.actor_id=u.id) 
        WHERE e.series_REF='$series_REF' 
        ORDER BY e.episode ASC";
        
        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 

    public function persona_in_episode_has_actor($episode_id, $persona_id, $actor_id)
    {    


        $conn = $this->getEntityManager()->getConnection();  
        
        $sql="DELETE FROM persona_in_episode_has_actor WHERE (episode_id='$episode_id' AND persona_id='$persona_id')";
        $conn->executeQuery($sql);

        $sql="INSERT INTO persona_in_episode_has_actor (episode_id, persona_id, actor_id) VALUES ('$episode_id','$persona_id','$actor_id')";
        $conn->executeQuery($sql);


    }

    public function get_persona_in_episode_has_actor()
    {  
        $conn = $this->getEntityManager()->getConnection();  
        $sql="SELECT p.episode_id, u.name as actor_name  FROM persona_in_episode_has_actor as p INNER JOIN users as u ON p.actor_id=u.id" ;
        $resultSet =  $conn->executeQuery($sql);
        return $resultSet->fetchAllAssociative();
    }




}
