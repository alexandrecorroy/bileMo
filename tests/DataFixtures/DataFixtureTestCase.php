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

namespace App\Tests\DataFixtures;

use Doctrine\Common\Cache\ApcuCache;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class DataFixtureTestCase.
 */
class DataFixtureTestCase extends WebTestCase
{
    /** @var  Application $application */
    protected static $application = null;

    /** @var  Client $client */
    protected $client = null;

    /** @var  ContainerInterface $container */
    protected static $container = null;

    /** @var  EntityManager $entityManager */
    protected $entityManager = null;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::runCommand('doctrine:database:drop --force');
        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:create');
        self::runCommand('doctrine:fixtures:load --append --no-interaction');

        $this->client        = static::createClient();
        self::$container     = $this->client->getContainer();
        $this->entityManager = self::$container->get('doctrine.orm.entity_manager');

        parent::setUp();
        $cache = new ApcuCache();
        $cache->deleteAll();
    }

    /**
     * @param $command
     *
     * @return int
     *
     * @throws \Exception
     */
    protected static function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    /**
     * @return Application
     */
    protected static function getApplication()
    {
        if (null === self::$application) {
            $client = static::createClient();

            self::$application = new Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        self::runCommand('doctrine:database:drop --force');

        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }

    /**
     * @return Client
     */
    protected function createAuthenticatedRoleUser()
    {
        $credentials = [
            'username' => 'sfr',
            'password' => 'sfr'
        ];

        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(),
            array(),
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($credentials)
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }


    /**
     * @return Client
     */
    protected function createAuthenticatedRoleAdmin()
    {
        $credentials = [
            'username' => 'admin',
            'password' => 'admin'
        ];

        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(),
            array(),
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($credentials)
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
}
