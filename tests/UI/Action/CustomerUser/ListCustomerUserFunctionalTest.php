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

/**
 * final Class ListCustomerUserFunctionalTest.
 */
final class ListCustomerUserFunctionalTest extends DataFixtureTestCase
{
    /**
     * test Response
     */
    public function testResponse()
    {
        $this->client = self::createAuthenticatedRoleUser();

        $this->client->request('GET', '/api/customerUsers');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }

}
