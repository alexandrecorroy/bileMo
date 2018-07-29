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

use App\Entity\Interfaces\ProductDetailInterface;
use App\Entity\Interfaces\ProductInterface;
use App\Entity\ProductDetail;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

/**
 * final Class ProductDetailUnitTest
 */
final class ProductDetailUnitTest extends TestCase
{

    /**
     * @var ProductInterface|null
     */
    private $product = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->product = $this->createMock(ProductInterface::class);
    }

    /**
     * Unit test add product detail
     */
    public function testAddProductDetail()
    {
        $productDetail = new ProductDetail(
            "LG",
            "black",
            "Android KitKat",
            32,
            155,
            5.5,
            148.9,
            76.1,
            9.8,
            $this->product
        );

        static::assertInstanceOf(ProductDetailInterface::class, $productDetail);
        static::assertInstanceOf(UuidInterface::class, $productDetail->getUid());
        static::assertEquals("LG", $productDetail->getBrand());
        static::assertEquals("black", $productDetail->getColor());
        static::assertEquals(148.9, $productDetail->getHeight());
        static::assertEquals(32, $productDetail->getMemory());
        static::assertEquals("Android KitKat", $productDetail->getOs());
        static::assertEquals(5.5, $productDetail->getScreenSize());
        static::assertEquals(9.8, $productDetail->getThickness());
        static::assertEquals(155, $productDetail->getWeight());
        static::assertEquals(76.1, $productDetail->getWidth());
    }
}
