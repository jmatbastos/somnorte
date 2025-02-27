<?php

namespace App\Repository;

use App\Entity\Cachets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cachets>
 */
class CachetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cachets::class);
    }

    public function insert_cachets($contents)
    {
    
        $contents_array = explode(';', $contents);  
        if ( is_numeric($contents_array[2]) ) { 

            $conn = $this->getEntityManager()->getConnection();

            // check if cachet already exists in database; if not add  

  
            $cachet_inicial = mb_convert_encoding($contents_array[4], 'UTF-8', 'Windows-1252'); 
            $pago = mb_convert_encoding($contents_array[5], 'UTF-8', 'Windows-1252'); 
            $saldo = mb_convert_encoding($contents_array[6], 'UTF-8', 'Windows-1252'); 
            $cachet_contab = mb_convert_encoding($contents_array[7], 'UTF-8', 'Windows-1252');
            $cachet_p_contab = mb_convert_encoding($contents_array[8], 'UTF-8', 'Windows-1252'); 
            $status = mb_convert_encoding($contents_array[9], 'UTF-8', 'Windows-1252');                                                                   
            
            $sql = "INSERT IGNORE INTO cachets (ref, month, nif, cachet_inicial, pago, saldo,cachet_contab,cachet_p_contab, status) VALUES ('$contents_array[0]','$contents_array[1]','$contents_array[2]','$cachet_inicial','$pago','$saldo','$cachet_contab','$cachet_p_contab','$status')";
            $conn->executeQuery($sql);
        }    

    }

    public function get_cachets()
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT c.*, u.name FROM cachets as c INNER JOIN users AS u ON c.nif=u.nif";
        
    
        $resultSet =  $conn->executeQuery($sql);

        return $resultSet->fetchAllAssociative();
    }

    public function insert_users($contents)
    {
    
        $contents_array = explode(';', $contents);  
 
        if ( is_numeric($contents_array[2]) ) {
            $name_end = strpos($contents_array[3], '(');
            if ($name_end != FALSE) 
                $name = substr($contents_array[3],0,$name_end);
            else 
                $name = $contents_array[3];
            
            $conn = $this->getEntityManager()->getConnection();

                // check if user already exists in database; if not add 
                
                $nif_altered = $contents_array[2] + 123456789;
                $sql = "SELECT * FROM `users` WHERE nif='$nif_altered'";

                $resultSet =  $conn->executeQuery($sql);

                if ( $resultSet->fetchAllAssociative() == NULL) {
                    // user does not exist in database
                    $email='a' . random_int(1000, 10000) . '@gmail.com';
                    $roles = '["ROLE_ACTOR"]';
                    $password=password_hash(random_int(1000, 10000), PASSWORD_DEFAULT);
                    $name = mb_convert_encoding($name,'UTF-8','Windows-1252');
                    $sql = "INSERT INTO users SET name='$name', nif='$contents_array[2]',email='$email' ,roles='$roles', password='$password' ";
                    $conn->executeQuery($sql);
                }

            }



    }




}

