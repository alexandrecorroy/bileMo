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
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class DeleteCustomerUserFunctionalTest.
 */
final class DeleteCustomerUserFunctionalTest extends DataFixtureTestCase
{
    /**
     * test delete a customerUser
     */
    public function testDeleteCustomerUser()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', '/api/customerUsers');

        $customerUsers = json_decode($this->client->getResponse()->getContent(), true);

        foreach ($customerUsers as $customerUser)
        {
            $this->client->request('DELETE', '/api/customerUser/'.$customerUser['uid']);

            static::assertEquals(Response::HTTP_ACCEPTED, $this->client->getResponse()->getStatusCode());
            static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
        }
    }
}
