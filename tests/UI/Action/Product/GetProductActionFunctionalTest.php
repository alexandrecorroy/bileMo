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

class GetProductActionFunctionalTest extends WebTestCase
{

    /**
     * @var null
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
        $client = $this->client->request('GET', '/product/list');

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}