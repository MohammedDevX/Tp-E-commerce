<?php

namespace App\Controller;

use App\Form\AddToCartType;
use App\Services\Cart\CartHandler;
use App\Services\Cart\CartInterface;
use App\Services\Product\PorductHandler;
use App\Services\Product\ProducServicetInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
final class ProductController extends AbstractController
{
    public function __construct(
        #[Autowire(service: CartHandler::class)] private  CartInterface $cartService,
        #[Autowire(service: PorductHandler::class)] private ProducServicetInterface $productService
    ) {}

    #[Route('/details/{id}', name: 'app_product_detaille')]
    public function getProductDetails(int $id, Request $request): Response
    {
        $cart = $this->cartService->addCartToUser();
        $product = $this->productService->getProduct($id);
        if (!$product) {
            throw $this->createNotFoundException('Product doesnt existe');
        }

        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $quantity = $data['quantity'];
            $this->cartService->addItemToCart($cart, $product, $quantity);
            return $this->redirectToRoute('app_product_detaille', [
                'id' => $id
            ]);
        }
        return $this->render('files/product_details.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }

    #[Route('/categori', name: 'app_product_by_categori')]
    public function getProductByCategori(): Response
    {
        return $this->render('files/product_categori.html.twig');
    }
}
