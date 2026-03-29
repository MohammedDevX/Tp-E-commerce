<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CartItem>
 */
class CartItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function addToCart(Cart $cart, Product $product, int $quantity): void {
        $cartItem = $this->findOneBy([
            'cart_id' => $cart,
            'product_id' => $product
        ]);

        if ($cartItem != null) {
            $cartItem->setQuantity($quantity);
        } else {
            $cartItem = new CartItem();
            $cartItem->setCartId($cart);
            $cartItem->setProductId($product);
            $cartItem->setQuantity($quantity);
        }

        $em = $this->getEntityManager();
        $em->persist($cartItem);
        $em->flush();
    }
}
