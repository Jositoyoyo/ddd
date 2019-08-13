<?php

namespace App\Repository;

use App\Entity\AdysaGroupWebServiceService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AdysaGroupWebRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Entradas::class);
    }
    
   

}
