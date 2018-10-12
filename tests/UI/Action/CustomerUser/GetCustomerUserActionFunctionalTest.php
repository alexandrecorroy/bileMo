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

/**
 * final Class GetCustomerUserActionFunctionalTest.
 */
final class GetCustomerUserActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * test customer user is returned
     */
    public function testCustomerUserIsReturned()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', '/api/customerUsers');

        $customerUsers = json_decode($this->client->getResponse()->getContent(), true);

        foreach ($customerUsers as $customerUser)
        {
            $this->client->request('GET', '/api/customerUser/'.$customerUser['uid']);

            static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
            static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
        }
    }

    /**
     * test custom user not found
     */
    public function testCustomerUserNotFound()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', '/api/customerUser/'.Uuid::uuid4());

        static::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }
}
