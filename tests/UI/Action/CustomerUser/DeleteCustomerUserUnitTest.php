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
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @var Request|null
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
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->repository = $this->createMock(CustomerUserRepositoryInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $request = Request::create('/', 'GET');
        $this->request = $request->duplicate(null, null, ['id' => 1]);
        $this->responder = $this->createMock(DeleteCustomerUserResponderInterface::class);
        $this->notFoundResponder = $this->createMock(NotFoundCustomerUserResponderInterface::class);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        static::assertInstanceOf(DeleteCustomerUserActionInterface::class, new DeleteCustomerUserAction($this->entityManager, $this->repository));
    }

    /**
     * test response is returned
     */
    public function testResponseIsReturned()
    {
        $customerUser = $this->createMock(CustomerUserInterface::class);
        $this->repository->method('findOneByUuidField')->willReturn($customerUser);

        $deleteCustomerUserAction = new DeleteCustomerUserAction($this->entityManager, $this->repository);
        static::assertInstanceOf(Response::class, $deleteCustomerUserAction($this->request, $this->responder, $this->notFoundResponder));
    }
}
