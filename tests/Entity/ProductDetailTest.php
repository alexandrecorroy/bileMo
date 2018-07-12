<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/2018
 * Time: 17:23
 */

namespace App\Tests\Entity;


use App\Entity\ProductDetail;
use PHPUnit\Framework\TestCase;

class ProductDetailTest extends TestCase
{

    public function initProductDetail()
    {
        $product = new ProductTest();
        $product = $product->initProduct();

        $productDetail = new ProductDetail();

        $productDetail->setBrand("LG")
            ->setColor("black")
            ->setHeight(148.9)
            ->setMemory(32)
            ->setOs("Android KitKat")
            ->setScreenSize(5.5)
            ->setThickness(9.8)
            ->setWeight(155)
            ->setWidth(76.1)
            ->setProduct($product);

        return $productDetail;
    }

    public function testAddProductDetail()
    {

        $productDetail = $this::initProductDetail();

        $this->assertEquals("LG", $productDetail->getBrand());
        $this->assertEquals("black", $productDetail->getColor());
        $this->assertEquals(148.9, $productDetail->getHeight());
        $this->assertEquals(32, $productDetail->getMemory());
        $this->assertEquals("Android KitKat", $productDetail->getOs());
        $this->assertEquals(5.5, $productDetail->getScreenSize());
        $this->assertEquals(9.8, $productDetail->getThickness());
        $this->assertEquals(155, $productDetail->getWeight());
        $this->assertEquals(76.1, $productDetail->getWidth());

    }

}