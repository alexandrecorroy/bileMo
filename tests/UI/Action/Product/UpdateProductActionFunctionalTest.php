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
 * final Class UpdateProductActionFunctionalTest.
 */
final class UpdateProductActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * @var array
     */
    private $products;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->products = $this->entityManager->getRepository(Product::class)->findAllProducts();
    }

    /**
     * test update a product
     */
    public function testUpdateProduct()
    {
        $productUpdated = [
            'name' => 'updated name',
            'productDetail' => [
                'brand' => 'brand',
                'screenSize' => 5.5,
                'height' => 155.7,
                'width' => 55.8
            ]
        ];

        foreach ($this->products as $product) {
            $this->client = self::createAuthenticatedRoleAdmin();
            $this->client->request('PATCH', '/api/product/'.$product->getUid()->__toString(), array(), array(), array(), json_encode($productUpdated));

            $product->updateProduct($productUpdated);
            $productDetail = $product->getProductDetail();
            $productDetail->updateProductDetail($productUpdated['productDetail']);

            static::assertEquals(Response::HTTP_NO_CONTENT, $this->client->getResponse()->getStatusCode());

            $this->client = self::createAuthenticatedRoleAdmin();
            $this->client->request('GET', '/api/product/'.$product->getUid()->__toString());
            static::assertEquals(json_encode($product), $this->client->getResponse()->getContent());

            break;
        }
    }
}
