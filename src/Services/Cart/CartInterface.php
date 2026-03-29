<?php

namespace App\Services\Cart;

use App\Entity\Cart;
use App\Entity\Product;

interface CartInterface
{
    public function addCartToUser();
    public function addItemToCart(Cart $cart, Product $product, int $quantity);
}
