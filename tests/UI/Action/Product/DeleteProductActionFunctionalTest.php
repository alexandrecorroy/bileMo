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
use Symfony\Component\Routing\Router;

/**
 * final Class DeleteProductActionFunctionalTest.
 */
final class DeleteProductActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * @var Router|null
     */
    private $router = null;

    /**
     * @var array|null
     */
    private $products = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->products = $this->entityManager->getRepository(Product::class)->findAllProducts();
        $this->router = self::$container->get('router');
    }

    /**
     * test delete a product
     */
    public function testDeleteProduct()
    {
        $this->client = self::createAuthenticatedRoleAdmin();

        foreach ($this->products as $product)
        {
            $uri = $this->router->generate('product_delete', ['id' => $product->getUid()]);

            $this->client->request('DELETE', $uri);

            static::assertEquals(Response::HTTP_ACCEPTED, $this->client->getResponse()->getStatusCode());
            static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
        }
    }
}
