<?php

namespace App\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
Use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index()
    {
        return $this->render('home.html.twig', [
            
        ]);       
    }
}