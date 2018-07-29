<?php

declare(strict_types = 1);

/**
 * BileMo Project
 *
 * (c) CORROY Alexandre <alexandre.corroy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
    /**
     * unit test add a product
     */
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
