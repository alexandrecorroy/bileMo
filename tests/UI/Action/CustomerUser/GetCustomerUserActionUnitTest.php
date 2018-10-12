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
use App\UI\Action\CustomerUser\GetCustomerUserAction;
use App\UI\Action\CustomerUser\Interfaces\GetCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\ForbiddenCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\GetCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class GetCustomerUserActionUnitTest.
 */
final class GetCustomerUserActionUnitTest extends TestCase
{
    /**
     * @var CustomerUserRepositoryInterface|null
     */
    private $repository = null;

    /**
     * @var GetCustomerUserResponderInterface|null
     */
    private $responder = null;

    /**
     * @var NotFoundCustomerUserResponderInterface|null
     */
    private $notFoundResponder = null;

    /**
     * @var null
     */
    private $request = null;

    /**
     * @var ForbiddenCustomerUserResponderInterface|null
     */
    private $forbiddenResponder = null;

    /**
     * @var TokenStorageInterface|null
     */
    private $tokenStorage = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->repository         = $this->createMock(CustomerUserRepositoryInterface::class);
        $this->responder          = $this->createMock(GetCustomerUserResponderInterface::class);
        $this->notFoundResponder  = $this->createMock(NotFoundCustomerUserResponderInterface::class);
        $this->tokenStorage       = $this->createMock(TokenStorageInterface::class);
        $this->forbiddenResponder = $this->createMock(ForbiddenCustomerUserResponderInterface::class);
        $request                  = Request::create('/', 'GET');
        $this->request            = $request->duplicate(null, null, ['id' => 1]);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        static::assertInstanceOf(GetCustomerUserActionInterface::class, new GetCustomerUserAction($this->repository, $this->tokenStorage));
    }

    /**
     * test response is returned
     */
    public function testResponseIsReturned()
    {
        $customerUser   = $this->createMock(CustomerUserInterface::class);
        $tokenInterface = $this->createMock(TokenInterface::class);

        $this->repository->method('findOneByUuidField')->willReturn($customerUser);
        $this->tokenStorage->method('getToken')->willReturn($tokenInterface);
        $tokenInterface->method('getUser')->willReturn($customerUser);

        $customerUser = new GetCustomerUserAction(
            $this->repository,
            $this->tokenStorage
        );

        static::assertInstanceOf(Response::class, $customerUser($this->request, $this->responder, $this->notFoundResponder, $this->forbiddenResponder));
    }
}
