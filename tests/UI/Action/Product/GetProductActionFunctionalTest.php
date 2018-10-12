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
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class GetProductActionFunctionalTest.
 */
final class GetProductActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * @var array
     */
    private $products;

    protected function setUp()
    {
        parent::setUp();
        $this->products = $this->entityManager->getRepository(Product::class)->findAllProducts();
    }

    /**
     * test Response foreach product
     */
    public function testResponse()
    {
        $this->client = self::createAuthenticatedRoleUser();
        foreach ($this->products as $product) {
            $this->client->request('GET', '/api/product/'.$product->getUid()->__toString());

            static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
            static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
        }

    }

    /**
     * test not found response
     */
    public function testNotFound()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', '/api/product/'.Uuid::uuid4());

        static::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }
}
