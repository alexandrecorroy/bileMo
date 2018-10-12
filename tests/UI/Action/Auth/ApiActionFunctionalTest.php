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

namespace App\Test\UI\Action\Auth;

use App\Tests\DataFixtures\DataFixtureTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiActionFunctionalTest.
 */
final class ApiActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * test login with correct credential User
     */
    public function testLoginWithCorrectCredentialsUser()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', '/api');

        static::assertEquals(json_decode($this->client->getResponse()->getContent()), 'Logged in as sfr');
        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));

    }

    /**
     * test login with correct credential Admin
     */
    public function testLoginWithCorrectCredentialsAdmin()
    {
        $this->client = self::createAuthenticatedRoleAdmin();
        $this->client->request('GET', '/api');

        static::assertEquals(json_decode($this->client->getResponse()->getContent()), 'Logged in as admin');
        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));

    }

    /**
     * test login with incorrect credential
     */
    public function testLoginWithIncorrectCredentials()
    {
        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', 'FakeTokenNotLong'));

        $client->request('GET', '/api');

        static::assertEquals(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
        static::assertTrue($client->getResponse()->headers->contains('content-type', 'application/json'));

    }
}
