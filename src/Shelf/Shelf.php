<?php

declare(strict_types=1);

namespace App\Shelf;

final class Shelf
{
    private $priceMap = [];

    public function setProductPrice($product, $price)
    {
        $this->priceMap[$product] = $price;
    }

    public function getProductPrice($product)
    {
        return $this->priceMap[$product];
    }

}