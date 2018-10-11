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

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\Routing\Router;

/**
 * Class ApiActionFunctionalTest.
 */
final class ApiActionFunctionalTest extends WebTestCase
{
    /**
     * @var Router|null
     */
    private $router = null;

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
        $this->router = self::$container->get('router');
    }

    /**
     * test login with correct credential User
     */
    public function testLoginWithCorrectCredentialsUser()
    {
        $credentials = [
            'username' => 'sfr',
            'password' => 'sfr'
        ];

        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/api/login_check',
            array(),
            array(),
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($credentials)
        );

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->client = static::createClient();
        $this->client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        $uri = $this->router->generate('api');
        $this->client->request('GET', $uri);

        static::assertEquals(json_decode($this->client->getResponse()->getContent()), 'Logged in as sfr');
        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));

    }

    /**
     * test login with correct credential Admin
     */
    public function testLoginWithCorrectCredentialsAdmin()
    {
        $credentials = [
            'username' => 'admin',
            'password' => 'admin'
        ];

        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/api/login_check',
            array(),
            array(),
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($credentials)
        );

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->client = static::createClient();
        $this->client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));


        $uri = $this->router->generate('api');
        $this->client->request('GET', $uri);

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

        $uri = $this->router->generate('api');
        $client->request('GET', $uri);

        static::assertEquals(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
        static::assertTrue($client->getResponse()->headers->contains('content-type', 'application/json'));

    }
}
