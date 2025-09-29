<?php

namespace App\Repository;

use App\Entity\Visites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Visites>
 */
class VisitesRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Visites::class);
    }

    /**
     * 
     * @param type $champ
     * @param type $order
     * @return Visites[]
     */
    public function findAllOrderBy($champ, $order): array {
        if (
                $champ == null || $champ == "" ||
                $order == null || ($order != "ASC" && $order != "DESC")
        ) {
            
            return null;
        }

        return $this->createQueryBuilder("visitesTable")
            ->orderBy("visitesTable.".$champ, $order)
            ->getQuery()
            ->getResult();
    }
}
