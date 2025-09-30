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
                        ->orderBy("visitesTable." . $champ, $order)
                        ->getQuery()
                        ->getResult();
    }

    /**
     * 
     * @param type $champ
     * @param type $value
     * @return Visites[]
     */
    public function findByData($champ, $value): array {
        if ($value == "") {
            return $this->findAllOrderBy($champ, "ASC");
        }

        return $this->createQueryBuilder("visitesTable")
                        ->where("visitesTable." . $champ . " = :valeur")
                        ->setParameter(":valeur", $value)
                        ->getQuery()
                        ->getResult();
    }
    
    /**
     * 
     * @param Visite $visite
     * @return void
     */
    public function remove(Visites $visite) : void {
        $this->getEntityManager()->remove($visite);
        $this->getEntityManager()->flush();
    }
}
