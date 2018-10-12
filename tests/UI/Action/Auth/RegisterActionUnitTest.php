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

use App\Entity\Customer;
use App\UI\Action\Auth\Interfaces\RegisterActionInterface;
use App\UI\Action\Auth\RegisterAction;
use App\UI\Responder\Auth\Interfaces\RegisterResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class RegisterActionUnitTest.
 */
final class RegisterActionUnitTest extends TestCase
{
    /**
     * @var SerializerInterface|null
     */
    private $serializer = null;

    /**
     * @var UserPasswordEncoderInterface|null
     */
    private $encoder = null;

    /**
     * @var ValidatorInterface|null
     */
    private $validator = null;

    /**
     * @var EntityManagerInterface|null
     */
    private $entityManager = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->encoder = $this->createMock(UserPasswordEncoderInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $class = new RegisterAction($this->serializer, $this->encoder, $this->validator, $this->entityManager);

        static::assertInstanceOf(RegisterActionInterface::class, $class);
    }

    /**
     * test if response is returned
     */
    public function testResponseIsReturned()
    {
        $request = Request::create('/', 'POST');
        $request = $request->duplicate(null, null);
        $customer = $this->createMock(Customer::class);
        $responder = $this->createMock(RegisterResponderInterface::class);
        $this->validator->method('validate')->willReturn([]);
        $this->serializer->method('deserialize')->willReturn($customer);

        $class = new RegisterAction($this->serializer, $this->encoder, $this->validator, $this->entityManager);

        static::assertInstanceOf(Response::class, $class($request, $responder));
    }
}
