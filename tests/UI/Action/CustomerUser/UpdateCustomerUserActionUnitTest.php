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
use App\UI\Action\CustomerUser\Interfaces\UpdateCustomerUserActionInterface;
use App\UI\Action\CustomerUser\UpdateCustomerUserAction;
use App\UI\Responder\CustomerUser\Interfaces\ForbiddenCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\UpdateCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class UpdateCustomerUserActionUnitTest.
 */
final class UpdateCustomerUserActionUnitTest extends TestCase
{
    /**
     * @var EntityManagerInterface|null
     */
    private $entityManager = null;

    /**
     * @var CustomerUserRepositoryInterface|null
     */
    private $repository = null;

    /**
     * @var ValidatorInterface|null
     */
    private $validator = null;

    /**
     * @var TokenStorageInterface|null
     */
    private $tokenStorage = null;

    /**
     * @var null
     */
    private $request = null;

    /**
     * @var UpdateCustomerUserResponderInterface|null
     */
    private $responder = null;

    /**
     * @var NotFoundCustomerUserResponderInterface|null
     */
    private $notFoundResponder = null;

    /**
     * @var ForbiddenCustomerUserResponderInterface|null
     */
    private $forbiddenResponder = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->entityManager      = $this->createMock(EntityManagerInterface::class);
        $this->repository         = $this->createMock(CustomerUserRepositoryInterface::class);
        $this->validator          = $this->createMock(ValidatorInterface::class);
        $this->tokenStorage       = $this->createMock(TokenStorageInterface::class);
        $this->responder          = $this->createMock(UpdateCustomerUserResponderInterface::class);
        $this->notFoundResponder  = $this->createMock(NotFoundCustomerUserResponderInterface::class);
        $this->forbiddenResponder = $this->createMock(ForbiddenCustomerUserResponderInterface::class);
        $request                  = Request::create('/', 'PATCH');
        $this->request            = $request->duplicate(null, null, ['id' => 1]);

    }

    /**
     * test UpdateCustomerUserAction
     */
    public function testUpdateCustomerUserAction()
    {
        $updateCustomerUserAction = new UpdateCustomerUserAction(
            $this->entityManager,
            $this->repository,
            $this->validator,
            $this->tokenStorage
        );

        static::assertInstanceOf(UpdateCustomerUserActionInterface::class, $updateCustomerUserAction);
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

        $action = new UpdateCustomerUserAction(
            $this->entityManager,
            $this->repository,
            $this->validator,
            $this->tokenStorage
        );

        static::assertInstanceOf(Response::class, $action($this->request, $this->responder, $this->notFoundResponder, $this->forbiddenResponder));
    }
}
