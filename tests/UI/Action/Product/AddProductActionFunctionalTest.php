<?php

declare(strict_types=1);

/**
 * BileMo Project
 *
 * (c) CORROY Alexandre <alexandre.corroy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Action\Product;

use App\Entity\Product;
use App\Tests\DataFixtures\DataFixtureTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class AddProductActionFunctionalTest.
 */
final class AddProductActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * test add new product
     */
    public function testAddProduct()
    {
        $array = [
            'name' => 'Phone',
            'price' => 255.90,
            'productDetail' => [
                'brand' => 'brand',
                'color' => 'orange',
                'os' => 'Android 10',
                'memory' => 64,
                'weight' => 166.4,
                'screenSize' => 5.5,
                'height' => 155.7,
                'width' => 55.8,
                'thickness' => 8.8
            ]
        ];

        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleAdmin();
        $this->client->request('POST', 'api/product', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }

    /**
     * test add product without one parameter
     */
    public function testAddProductWithoutOneParameter()
    {
        $array = [
            'name' => 'Phone',
            'price' => 255.90,
            'productDetail' => [
                'brand' => 'brand',
                'color' => 'orange',
                'os' => 'Android 10',
                'memory' => 64,
                'weight' => 166.4,
                'height' => 155.7,
                'width' => 55.8,
                'thickness' => 8.8
            ]
        ];

        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleAdmin();
        $this->client->request('POST', 'api/product', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_PARTIAL_CONTENT, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }

    /**
     * test add product with parameter bad type
     */
    public function testAddProductWithBadType()
    {
        $array = [
            'name' => 'Phone',
            'price' => 255.90,
            'productDetail' => [
                'brand' => 'brand',
                'color' => 'orange',
                'os' => 'Android 10',
                'memory' => 64,
                'weight' => "166.4",
                'screenSize' => 5.5,
                'height' => 155.7,
                'width' => 55.8,
                'thickness' => 8.8
            ]
        ];

        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleAdmin();
        $this->client->request('POST', 'api/product', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }

    /**
     * test add product null
     */
    public function testAddProductNull()
    {
        $array = [];

        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleAdmin();
        $this->client->request('POST', 'api/product', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_PARTIAL_CONTENT, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }

    /**
     * test product already exist
     */
    public function testAddProductAlreadyExist()
    {
        $products = $this->entityManager->getRepository(Product::class)->findAllProducts();

        $product = $products[0];
        $productDetail = $product->getProductDetail();
        $array = [
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'productDetail' => [
                'brand' => $productDetail->getBrand(),
                'color' => $productDetail->getColor(),
                'os' => $productDetail->getOs(),
                'memory' => $productDetail->getMemory(),
                'weight' => $productDetail->getWeight(),
                'screenSize' => $productDetail->getScreenSize(),
                'height' => $productDetail->getHeight(),
                'width' => $productDetail->getWidth(),
                'thickness' => $productDetail->getThickness()
            ]
        ];

        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleAdmin();
        $this->client->request('POST', 'api/product', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_SEE_OTHER, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }

}
