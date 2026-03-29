<?php

namespace App\Entity;

use App\Repository\CartItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartItemRepository::class)]
#[ORM\UniqueConstraint(name: "cart_product_unique", columns: ["cart_id", "product_id"])]
class CartItem
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Cart $cart_id = null;

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Product $product_id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getCartId(): ?int
    {
        return $this->cart_id;
    }

    public function setCartId(Cart $cart_id): static
    {
        $this->cart_id = $cart_id;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(Product $product_id): static
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity =+ $quantity;
        return $this;
    }
}
