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


}
