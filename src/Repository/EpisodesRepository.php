<?php

namespace App\Repository;

use App\Entity\Episodes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Episodes>
 */
class EpisodesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Episodes::class);
    }

    public function insert_episodes($contents)
    {
    
        $contents_array = explode(',', $contents);  
 

        $conn = $this->getEntityManager()->getConnection();


        // check if episode already exists in database; if not add  
        
        $sql = "INSERT IGNORE INTO episodes (series_REF, episode) VALUES ('$contents_array[0]','$contents_array[1]')";
        $conn->executeQuery($sql);


    }

    public function insert_no_of_lines($contents)
    {    

        $contents_array = explode(',', $contents);



        $conn = $this->getEntityManager()->getConnection();        

        $sql="INSERT IGNORE INTO no_of_lines (episode_id, persona_id, no_of_lines) VALUES ( (select id from `episodes` where (episode='$contents_array[1]' AND series_REF='$contents_array[0]') ), (select id from `personas` where (name='$contents_array[2]' AND series_REF='$contents_array[0]') ), '$contents_array[3]')";

        $conn->executeQuery($sql);


    }


}
