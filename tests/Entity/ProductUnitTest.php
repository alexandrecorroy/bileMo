<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/2018
 * Time: 17:22
 */
declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Entity\Interfaces\ProductInterface;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

/**
 * final Class ProductUnitTest
 */
final class ProductUnitTest extends TestCase
{
    public function testAddProduct()
    {
        $product = new Product(
            "LG G4",
            189.99
        );

        static::assertInstanceOf(ProductInterface::class, $product);
        static::assertInstanceOf(UuidInterface::class, $product->getUid());
        static::assertEquals("LG G4", $product->getName());
        static::assertEquals(189.99, $product->getPrice());
    }
}
