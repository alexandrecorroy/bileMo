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

use App\Entity\Interfaces\CustomerUserInterface;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Action\CustomerUser\DeleteCustomerUserAction;
use App\UI\Action\CustomerUser\Interfaces\DeleteCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\DeleteCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\ForbiddenCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class DeleteCustomerUserUnitTest.
 */
final class DeleteCustomerUserUnitTest extends TestCase
{
    /**
     * @var CustomerUserRepositoryInterface|null
     */
    private $repository = null;

    /**
     * @var null
     */
    private $request = null;

    /**
     * @var EntityManagerInterface|null
     */
    private $entityManager = null;

    /**
     * @var DeleteCustomerUserResponderInterface|null
     */
    private $responder = null;

    /**
     * @var NotFoundCustomerUserResponderInterface|null
     */
    private $notFoundResponder = null;

    /**
     * @var TokenStorageInterface|null
     */
    private $tokenStorage = null;

    /**
     * @var ForbiddenCustomerUserResponderInterface|null
     */
    private $forbiddenResponder = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->repository = $this->createMock(CustomerUserRepositoryInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->responder = $this->createMock(DeleteCustomerUserResponderInterface::class);
        $this->notFoundResponder = $this->createMock(NotFoundCustomerUserResponderInterface::class);
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
        $this->forbiddenResponder = $this->createMock(ForbiddenCustomerUserResponderInterface::class);

        $request = Request::create('/', 'DELETE');
        $this->request = $request->duplicate(null, null, ['id' => 1]);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        static::assertInstanceOf(DeleteCustomerUserActionInterface::class, new DeleteCustomerUserAction($this->entityManager, $this->repository, $this->tokenStorage));
    }

    /**
     * test response is returned
     */
    public function testResponseIsReturned()
    {
        $customerUser = $this->createMock(CustomerUserInterface::class);
        $tokenInterface = $this->createMock(TokenInterface::class);

        $this->repository->method('findOneByUuidField')->willReturn($customerUser);
        $this->tokenStorage->method('getToken')->willReturn($tokenInterface);
        $tokenInterface->method('getUser')->willReturn($customerUser);

        $deleteCustomerUserAction = new DeleteCustomerUserAction($this->entityManager, $this->repository, $this->tokenStorage);
        static::assertInstanceOf(Response::class, $deleteCustomerUserAction($this->request, $this->responder, $this->notFoundResponder, $this->forbiddenResponder));
    }
}
