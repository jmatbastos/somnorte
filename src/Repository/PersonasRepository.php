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

    public function get_personas($series_REF)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT id, name FROM `personas` WHERE series_REF='$series_REF'";

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


}
