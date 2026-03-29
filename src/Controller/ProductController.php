<?php

namespace App\Controller;

use App\Form\AddToCartType;
use App\Services\Product\CartInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
final class ProductController extends AbstractController
{
    public function __construct(
        private CartInterface $productService
    )
    {}

    #[Route('/details/{id}', name: 'app_product_detaille')]
    public function getProductDetails(int $id): Response
    {
        $form = $this->createForm(AddToCartType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart = $this->productService->addCartToUser($id);
            $this->productService->addItemToCart();
            return $this->redirectToRoute('task_success');
        }
        return $this->render('files/product_details.html.twig');
    }

    #[Route('/categori', name: 'app_product_by_categori')]
    public function getProductByCategori(): Response
    {
        return $this->render('files/product_categori.html.twig');
    }
}
