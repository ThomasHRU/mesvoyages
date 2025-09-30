<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use App\Repository\VisitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author thoma
 */
class VoyagesController extends AbstractController {

    #[Route('/voyages', name: 'voyages')]
    public function index(): Response {
        $visites = $this->repository->findAllOrderBy("datecreation", "DESC");

        return $this->render("pages/voyages.html.twig", [
                    'visites' => $visites
        ]);
    }

    #[Route('/voyages/filter/{champ}/{order}', name: "voyagesFilter")]
    public function filter($champ, $order): Response {
        $visites = $this->repository->findAllOrderBy($champ, $order);
        return $this->render("pages/voyages.html.twig", [
                    "visites" => $visites
        ]);
    }

    #[Route('voyages/sort/{champ}', name: "voyagesSort")]
    public function sort($champ, Request $request): Response {
        $value = $request->get("sortValue");
        $visites = $this->repository->findByData($champ, $value);
        return $this->render("pages/voyages.html.twig", [
                    "visites" => $visites
        ]);
    }

    /**
     * 
     * @var VisitesRepository
     */
    private $repository;

    /**
     * 
     * @param VisitesRepository $repository
     */
    public function __construct(VisitesRepository $repository) {
        $this->repository = $repository;
    }
}
