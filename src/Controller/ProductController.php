<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
final class ProductController extends AbstractController
{
    #[Route('/details', name: 'app_product_detaille')]
    public function getProductDetails(): Response
    {
        return $this->render('files/product_details.html.twig', [
            'controller_name' => 'ProductDetailleController',
        ]);
    }

    #[Route('/categori', name: 'app_product_by_categori')]
    public function getProductByCategori(): Response
    {
        return $this->render('files/product_categori.html.twig', [
            'controller_name' => 'ProductDetailleController',
        ]);
    }
}
