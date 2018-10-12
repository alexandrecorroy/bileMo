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

namespace App\Test\UI\Action\CustomerUser;

use App\Entity\CustomerUser;
use App\Tests\DataFixtures\DataFixtureTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * final Class UpdateCustomerUserFunctionalTest.
 */
final class UpdateCustomerUserFunctionalTest extends DataFixtureTestCase
{
    /**
     * @var Router|null
     */
    private $router = null;

    /**
     * @var SerializerInterface|null
     */
    private $serializer = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->router = self::$container->get('router');
        $this->serializer = self::$container->get('serializer');
    }

    /**
     * test update a customerUser
     */
    public function testUpdateProduct()
    {
        $this->client = self::createAuthenticatedRoleUser();

        $this->client->request('GET', $this->router->generate('customer_user_list'));

        $customerUsers = json_decode($this->client->getResponse()->getContent(), true);

        $this->client->request('GET', $this->router->generate('product_list'));

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $products = [];
        foreach ($data as $product)
        {
            $products[]['uid'] = $product['uid'];
        }

        $customerUserUpdated = [
            'name' => 'updated name',
            'products' => $products
        ];

        foreach ($customerUsers as $customerUser) {
            $uri = $this->router->generate('customer_user_update', ['id' => $customerUser['uid']]);

            $this->client = self::createAuthenticatedRoleUser();
            $this->client->request('PATCH', $uri, array(), array(), array(), json_encode($customerUserUpdated));

            static::assertEquals(Response::HTTP_NO_CONTENT, $this->client->getResponse()->getStatusCode());

            $uri = $this->router->generate('customer_user_show', ['id' => $customerUser['uid']]);
            $this->client = self::createAuthenticatedRoleUser();
            $this->client->request('GET', $uri);

            $customer = json_decode($this->client->getResponse()->getContent(), true);
            static::assertEquals($customer['name'], $customerUserUpdated['name']);

            break;
        }
    }
}
