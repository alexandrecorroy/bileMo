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

namespace App\Test\EventListener;

use App\Tests\DataFixtures\DataFixtureTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ExceptionListenerFunctionalTest.
 */
final class ExceptionListenerFunctionalTest extends DataFixtureTestCase
{
    /**
     * method not allow
     */
    public function testMethodNotAllow()
    {
        $this->client->request('GET', '/api/login_check');

        static::assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }

    /**
     * route not found
     */
    public function testRouteNotFound()
    {
        $this->client->request('GET', '/api/not_found');

        static::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
    }
}
