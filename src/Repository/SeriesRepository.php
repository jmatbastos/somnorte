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

    public function get_clients()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT id, name FROM `users` WHERE roles ='[\"CLIENT\"]'";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 

    public function create_series($ref, $name, $client_id)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "INSERT INTO series (REF, name, client_id) VALUES ('$ref','$name','$client_id')";

        $conn->executeQuery($sql);

    }
}
