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

namespace App\Tests\UI\Action\CustomerUser;

use App\Tests\DataFixtures\DataFixtureTestCase;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

/**
 * final Class GetCustomerUserActionFunctionalTest.
 */
final class GetCustomerUserActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * @var Router|null
     */
    private $router = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->router = self::$container->get('router');
    }

    /**
     * test customer user is returned
     */
    public function testCustomerUserIsReturned()
    {
        $uri = $this->router->generate('customer_user_list');
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', $uri);

        $customerUsers = json_decode($this->client->getResponse()->getContent());

        foreach ($customerUsers as $customerUser)
        {
            $uri = $this->router->generate('customer_user_show', ['id' => $customerUser->{'uid'}]);

            $this->client->request('GET', $uri);

            static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
            static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
        }
    }

    /**
     * test custom user not found
     */
    public function testCustomerUserNotFound()
    {
        $uri = $this->router->generate('customer_user_show', ['id' => Uuid::uuid4()]);

        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', $uri);

        static::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }
}
