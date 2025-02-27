<?php

namespace App\Repository;

use App\Entity\Invoices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Invoices>
 */
class InvoicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoices::class);
    }



    public function create_invoices($user_id, $ref, $reference, $type, $value, $date, $filename)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO invoices (user_id, ref, type, value, invoice_ref, invoice_date, register_date, filename) VALUES ('$user_id','$ref','$type','$value','$reference','$date',NOW(),'$filename')";

        $conn->executeQuery($sql);

        if ($type=='Invoice' )         
            $sql = "UPDATE cachets SET invoice_ref='$reference' WHERE ref='$ref'";
        if ($type=='Receipt' )         
            $sql = "UPDATE cachets SET receipt_ref='$reference' WHERE ref='$ref'";
        if ($type=='Invoice/Receipt' )         
            $sql = "UPDATE cachets SET invoice_ref='$reference', receipt_ref='$reference' WHERE ref='$ref'";            
        
        $conn->executeQuery($sql);

    }
    public function get_Invoices()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT s.id, s.REF, s.name, u.name as client_name FROM `Invoices` as s INNER JOIN users as u ON s.client_id=u.id";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    } 

    public function get_Invoices_by_user_ID($user_id)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT * FROM `invoices` WHERE user_id='$user_id'";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    }

    public function get_invoice($ref)
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT * FROM `invoices` WHERE invoice_ref='$ref'";

        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();

    }



}

