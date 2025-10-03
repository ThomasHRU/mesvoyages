<?php

namespace App\Controller\Admin;

use App\Entity\Visites;
use App\Form\VisiteType;
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
class AdminVoyageController extends AbstractController {

    #[Route('/admin', name: 'admin')]
    public function index(): Response {
        $visites = $this->repository->findAllOrderBy("datecreation", "DESC");

        return $this->render("Admin/admin.voyage.html.twig", [
                    'visites' => $visites
        ]);
    }

    #[Route('/admin/delete/{id}', name: "adminDelete")]
    public function remove(int $id): Response {
        $visite = $this->repository->find($id);
        $this->repository->remove($visite);
        return $this->redirectToRoute("admin");
    }

    #[Route('/admin/edit/{id}', name: "adminEdit")]
    public function edit(int $id, Request $request): Response {
        $visite = $this->repository->find($id);
        $formVisite = $this->createForm(VisiteType::class, $visite);

        $formVisite->handleRequest($request);
        if ($formVisite->isSubmitted() && $formVisite->isValid()) {
            $this->repository->add($visite);
            return $this->redirectToRoute("admin");
        }

        return $this->render("Admin/admin.voyage.edit.html.twig", [
                    "visite" => $visite,
                    "formVisite" => $formVisite->createView()
        ]);
    }
    
    #[Route("/admin/add", name: "adminAdd")]
    public function add(Request $request) : Response {
        $visite = new Visites();
        $formVisite = $this->createForm(VisiteType::class, $visite);
        
        $formVisite->handleRequest($request);
        if ($formVisite->isSubmitted() && $formVisite->isValid()) {
            $this->repository->add($visite);
            return $this->redirectToRoute("admin");
        }

        return $this->render("Admin/admin.voyage.add.html.twig", [
                    "visite" => $visite,
                    "formVisite" => $formVisite->createView()
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
