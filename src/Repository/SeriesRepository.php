<?php

namespace App\Repository;

use App\Entity\Series;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Series>
 */
class SeriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Series::class);
    }



    public function create_series($ref, $name, $client_id)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "INSERT INTO series (REF, name, client_id) VALUES ('$ref','$name','$client_id')";

        $conn->executeQuery($sql);

    }
    public function get_series()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT s.id, s.REF, s.name, u.name as client_name FROM `series` as s INNER JOIN users as u ON s.client_id=u.id";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 

}
