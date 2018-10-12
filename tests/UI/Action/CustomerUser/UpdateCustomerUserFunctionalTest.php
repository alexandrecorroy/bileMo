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

use App\Tests\DataFixtures\DataFixtureTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * final Class UpdateCustomerUserFunctionalTest.
 */
final class UpdateCustomerUserFunctionalTest extends DataFixtureTestCase
{
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
        $this->serializer = self::$container->get('serializer');
    }

    /**
     * test update a customerUser
     */
    public function testUpdateProduct()
    {
        $this->client = self::createAuthenticatedRoleUser();

        $this->client->request('GET', '/api/customerUsers');

        $customerUsers = json_decode($this->client->getResponse()->getContent(), true);

        $this->client->request('GET', '/api/products');

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $products = [];
        foreach ($data as $product)
        {
            $products[]['uid'] = $product['uid'];
        }

        $customerUserUpdated = [
            'name'     => 'updated name',
            'products' => $products
        ];

        foreach ($customerUsers as $customerUser) {
            $this->client = self::createAuthenticatedRoleUser();
            $this->client->request('PATCH', '/api/customerUser/'.$customerUser['uid'], array(), array(), array(), json_encode($customerUserUpdated));

            static::assertEquals(Response::HTTP_NO_CONTENT, $this->client->getResponse()->getStatusCode());

            $this->client = self::createAuthenticatedRoleUser();
            $this->client->request('GET', '/api/customerUser/'.$customerUser['uid']);

            $customer = json_decode($this->client->getResponse()->getContent(), true);
            static::assertEquals($customer['name'], $customerUserUpdated['name']);

            break;
        }
    }
}
