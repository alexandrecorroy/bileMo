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


use App\Entity\CustomerUser;
use App\Tests\DataFixtures\DataFixtureTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

/**
 * final Class DeleteCustomerUserFunctionalTest.
 */
final class DeleteCustomerUserFunctionalTest extends DataFixtureTestCase
{
    /**
     * @var Router|null
     */
    private $router = null;

    /**
     * @var array|null
     */
    private $customerUsers = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->customerUsers = $this->entityManager->getRepository(CustomerUser::class)->findAllCustomerUser();
        $this->router = self::$container->get('router');
    }

    /**
     * test delete a customerUser
     */
    public function testDeleteCustomerUser()
    {
        foreach ($this->customerUsers as $customerUser)
        {
            $uri = $this->router->generate('customer_user_delete', ['id' => $customerUser->getUid()]);

            $this->client->request('DELETE', $uri);

            static::assertEquals(Response::HTTP_ACCEPTED, $this->client->getResponse()->getStatusCode());
            static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));
        }
    }
}
