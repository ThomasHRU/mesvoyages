<?php

namespace App\Controller\Admin;

use App\Repository\VisitesRepository;
use App\Entity\Visites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author thoma
 */
class AdminVoyageController extends AbstractController {

    #[Route('/admin', name: 'admin')]
    public function index(): Response {
        $visites = $this->repository->findAllOrderBy("datecreation", "DESC");

        return $this->render("Admin/admin.voyage.html.twig", [
                    'visites' => $visites
        ]);
    }
    
    #[Route('/admin/delete/{id}', name: "adminDelete")]
    public function remove(int $id) : Response {
        $visite = $this->repository->find($id);
        $this->repository->remove($visite);
        return $this->redirectToRoute("admin");
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
