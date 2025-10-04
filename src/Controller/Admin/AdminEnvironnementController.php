<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\Admin;

use App\Entity\Environnement;
use App\Repository\EnvironnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of AdminEnvironnementController
 *
 * @author thoma
 */
class AdminEnvironnementController extends AbstractController {

    #[Route('/admin/environnement', name: 'adminEnv')]
    public function index(): Response {
        $environnements = $this->repository->findAll();

        return $this->render("Admin/admin.environnement.html.twig", [
                    'environnements' => $environnements
        ]);
    }
    
    #[Route('/admin/environnement/delete/{id}', name: "adminEnvDelete")]
    public function remove(int $id): Response {
        $environnement = $this->repository->find($id);
        $this->repository->remove($environnement);
        return $this->redirectToRoute("adminEnv");
    }
    
    #[Route("/admin/environnement/add", name: "adminEnvAdd")]
    public function add(Request $request) : Response {
        $nomEnvironnement = $request->get("nom");
        $environnement = new Environnement();
        $environnement->setNom($nomEnvironnement);
        $this->repository->add($environnement);
        return $this->redirectToRoute("adminEnv");
    }
    
    /**
     * 
     * @var EnvironnementRepository
     */
    private $repository;

    /**
     * 
     * @param EnvironnementRepository $repository
     */
    public function __construct(EnvironnementRepository $repository) {
        $this->repository = $repository;
    }
}
