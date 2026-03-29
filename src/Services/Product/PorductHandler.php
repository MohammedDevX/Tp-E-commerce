<?php

namespace App\Services\Product;

use App\Repository\ProductRepository;

class PorductHandler implements ProducServicetInterface
{
    public function __construct(
        private ProductRepository $product_repository
    )
    {}

    public function getProduct(int $id)
    {
        $this->product_repository->getProductById($id);
    }
}
