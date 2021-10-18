<?php

declare(strict_types=1);

namespace App\Basket;

use App\Shelf\Shelf;

final class Basket
{
    const VAT = 20;

    private $shelf;
    private $products;
    private $productsPrice = 0.0;

    public function __construct(Shelf $shelf)
    {
        $this->shelf = $shelf;
    }

    public function addProduct($product): void
    {
        $this->products[] = $product;
        $this->productsPrice += $this->shelf->getProductPrice($product);
    }

    public function products(): array
    {
        return $this->products;
    }

    public function total(): float
    {
        return $this->productsPrice
            + $this->vat()
            + $this->deliveryPrice();
    }

    private function vat(): float
    {
        return $this->productsPrice * (self::VAT / 100);
    }

    private function deliveryPrice(): float
    {
        return $this->productsPrice > 10 ? 2.0 : 3.0;
    }
}