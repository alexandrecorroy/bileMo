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

use App\Entity\Customer;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Action\CustomerUser\Interfaces\ListCustomerUserActionInterface;
use App\UI\Action\CustomerUser\ListCustomerUserAction;
use App\UI\Responder\CustomerUser\Interfaces\ListCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * final Class ListCustomerUserActionUnitTest.
 */
final class ListCustomerUserActionUnitTest extends TestCase
{
    /**
     * @var CustomerUserRepositoryInterface|null
     */
    private $repository = null;

    /**
     * @var EntityManagerInterface|null
     */
    private $entityManager = null;

    /**
     * @var TokenStorageInterface|null
     */
    private $tokenStorage = null;

    /**
     * @var null
     */
    private $request = null;

    /**
     * @var ListCustomerUserResponderInterface|null
     */
    private $responder = null;

    /**
     * @var NotFoundCustomerUserResponderInterface|null
     */
    private $notFoundResponder = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->repository        = $this->createMock(CustomerUserRepositoryInterface::class);
        $this->entityManager     = $this->createMock(EntityManagerInterface::class);
        $this->tokenStorage      = $this->createMock(TokenStorageInterface::class);
        $this->responder         = $this->createMock(ListCustomerUserResponderInterface::class);
        $this->notFoundResponder = $this->createMock(NotFoundCustomerUserResponderInterface::class);
        $request                 = Request::create('/', 'GET');
        $this->request           = $request->duplicate(null, null, ['id' => 1]);
    }

    /**
     * test ListCustomerUserAction
     */
    public function testListCustomerUserAction()
    {
        $listCustomerUserAction = new ListCustomerUserAction(
            $this->repository,
            $this->entityManager,
            $this->tokenStorage
        );

        static::assertInstanceOf(ListCustomerUserActionInterface::class, $listCustomerUserAction);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $tokenInterfaceMock = $this->createMock(TokenInterface::class);
        $customerMock = $this->createMock(Customer::class);

        $tokenInterfaceMock->method('getUser')->willReturn($customerMock);
        $this->tokenStorage->method('getToken')->willReturn($tokenInterfaceMock);

        $action = new ListCustomerUserAction(
            $this->repository,
            $this->entityManager,
            $this->tokenStorage
        );

        static::assertInstanceOf(Response::class, $action($this->request, $this->responder, $this->notFoundResponder));
    }
}
