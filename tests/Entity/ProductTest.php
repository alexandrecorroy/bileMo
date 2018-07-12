<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/2018
 * Time: 17:22
 */

namespace App\Tests\Entity;


use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    public function initProduct()
    {
        $product = new Product();

        $product->setName("LG G4")
            ->setPrice(189.99);

        return $product;
    }

    public function testAddProduct()
    {
        $product = $this::initProduct();

        $this->assertEquals("LG G4", $product->getName());
        $this->assertEquals(189.99, $product->getPrice());
    }

}