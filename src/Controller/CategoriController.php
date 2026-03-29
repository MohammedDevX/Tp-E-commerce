<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoriController extends AbstractController
{
    #[Route('/categories/brows', name: 'app_brows_categori')]
    public function index(): Response
    {
        return $this->render('files/browse_categories.html.twig', [
            'controller_name' => 'BrowsCategoriController',
        ]);
    }
}
