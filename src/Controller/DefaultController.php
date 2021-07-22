<?php

namespace App\Controller;

use App\Entity\Voyage;

Use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index()
    {
        $repo=$this->getDoctrine()->getRepository(Voyage::class);
        $voyages = $repo->findAll();

        return $this->render('home/home.html.twig', [
            'voyages' => $voyages,
            
        ]);
    }
    #[Route('/detail/{id}', name: 'detailVoyage')]
    public function showVoyage($id)
    {
        $repo=$this->getDoctrine()->getRepository(Voyage::class);
        $voyage = $repo->find($id);

        return $this->render('home/detail.html.twig', [
            'voyage' => $voyage,
            
        ]);
    }
}