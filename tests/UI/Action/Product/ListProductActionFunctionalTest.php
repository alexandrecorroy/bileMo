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
 * final Class ListProductActionFunctionalTest.
 */
final class ListProductActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * const int
     */
    const NUMBER_OF_PRODUCTS = 3;

    /**
     * test Response
     */
    public function testResponse()
    {
        $this->client->request('GET', '/products');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));

    }

    /**
     * test numbers of products
     */
    public function testNumbersProducts()
    {
        $products = $this->entityManager->getRepository(Product::class)->findAllProducts();

        static::assertEquals($this::NUMBER_OF_PRODUCTS, \count($products));
    }
}
