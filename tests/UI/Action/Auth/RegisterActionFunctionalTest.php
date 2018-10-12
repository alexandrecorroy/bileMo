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

class RegisterActionFunctionalTest extends DataFixtureTestCase
{
    /**
     * test add customer
     */
    public function testAddCustomer()
    {
        $this->client = self::createAuthenticatedRoleAdmin();

        $customer = [
            'society' => 'test',
            'email' => 'test@gmail.com',
            'username' => 'test',
            'password' => 'test',
            'phone' => '0566223355'
        ];

        $this->client->request('POST', '/api/register', array(), array(), array(), json_encode($customer));

        static::assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }

    /**
     * test add customer without one parameter
     */
    public function testAddCustomerWithoutOneParameter()
    {
        $this->client = self::createAuthenticatedRoleAdmin();

        $customer = [
            'society' => 'test',
            'username' => 'test',
            'password' => 'test',
            'phone' => '0566223355'
        ];

        $this->client->request('POST', '/api/register', array(), array(), array(), json_encode($customer));

        static::assertEquals(Response::HTTP_PARTIAL_CONTENT, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }

    /**
     * test add customer with bad assert
     */
    public function testAddCustomerWithBadAssert()
    {
        $this->client = self::createAuthenticatedRoleAdmin();

        $customer = [
            'society' => 'A very very very very very very very very very very very very very very very long society',
            'email' => 'test@gmail.com',
            'username' => 'test',
            'password' => 'test',
            'phone' => '0566223355'
        ];

        $this->client->request('POST', '/api/register', array(), array(), array(), json_encode($customer));

        static::assertEquals(Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }
}
