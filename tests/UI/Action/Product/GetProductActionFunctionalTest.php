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

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetProductActionFunctionalTest.
 */
final class GetProductActionFunctionalTest extends WebTestCase
{

    /**
     * @var Client|null
     */
    private $client = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * test response
     */
    public function testResponse()
    {
        $this->client->request('GET', '/product/list');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        static::assertSame("application/json", $this->client->getResponse()->headers->get('Content-Type'));
    }
}