<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use App\Basket\Basket;
use App\Shelf\Shelf;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $shelf;
    private $basket;

    public function __construct()
    {
        $this->shelf = new Shelf();
        $this->basket = new Basket($this->shelf);
    }

    /**
     * @Given there is a :arg1, which costs £:arg2
     */
    public function thereIsAWhichCostsPs($product, $price)
    {
        $this->shelf->setProductPrice($product, $price);
    }

    /**
     * @When I add the :arg1 to the basket
     */
    public function iAddTheToTheBasket($product)
    {
        $this->basket->addProduct($product);
    }

    /**
     * @Then I should have :arg1 product(s) in the basket
     */
    public function iShouldHaveProductInTheBasket($count)
    {
        \PHPUnit\Framework\assertCount(
            intval($count),
            $this->basket->products()
        );
    }

    /**
     * @Then the overall basket price should be £:arg1
     */
    public function theOverallBasketPriceShouldBePs($price)
    {
        \PHPUnit\Framework\assertSame(
            floatval($price),
            $this->basket->total()
        );
    }
}
