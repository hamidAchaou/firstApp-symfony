<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecipRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(RecipRepository $recipRepository): Response
    {
        $recipes = $recipRepository->findAll();
        // dd($recipes);
        return $this->render('pages/home.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('pages/about.html.twig');
    }
}
