<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use App\Repository\VisitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author thoma
 */
class VoyagesController extends AbstractController {
    
    #[Route('/voyages', name: 'voyages')]
    public function index() : Response {
        $visites = $this->repository->findAll();
        
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
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
