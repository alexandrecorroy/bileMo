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
use Symfony\Component\Routing\Router;

/**
 * final Class GetProductActionFunctionalTest.
 */
final class GetProductActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var array
     */
    private $products;

    protected function setUp()
    {
        parent::setUp();
        $this->products = $this->entityManager->getRepository(Product::class)->findAllProducts();
        $this->router = self::$container->get('router');
    }

    /**
     * test Response foreach product
     */
    public function testResponse()
    {
        $this->client = self::createAuthenticatedRoleUser();
        foreach ($this->products as $product) {
            $uri = $this->router->generate('product_show', ['id' => $product->getUid()->__toString()]);

            $this->client->request('GET', $uri);

            static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
            static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
        }

    }

    /**
     * test not found response
     */
    public function testNotFound()
    {
        $uri = $this->router->generate('product_show', ['id' => Uuid::uuid4()]);

        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', $uri);

        static::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }
}
