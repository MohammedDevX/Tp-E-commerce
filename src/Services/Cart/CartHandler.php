<?php

namespace App\Services\Product;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\CartItemRepository;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;

class CartHandler implements CartInterface
{
    public function __construct(
        private CartRepository $cart_repository,
        private RequestStack $requestStack,
        private EntityManager $em,
        private CartItemRepository $cart_item_repository
    )
    {}
    public function addCartToUser(int $id)
    {
        $session = $this->requestStack->getSession();
        $cartIdAsUser = $session->get('cart_id');
        $cart = $this->cart_repository->getProductById($id);
        if (!$cart) {
            $cart = new Cart();
            $this->em->persist($cart);
            $this->em->flush();

            // The user is filled in session by cart_id permanently
            $session->set('cart_id', $cart->getId());
        }

        return $cart;
    }

    public function addItemToCart(Cart $cart, Product $product, int $quantity)
    {
        $this->cart_item_repository->addItemToCart($cart, $product, $quantity);
        
    }
}
