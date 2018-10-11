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

namespace App\Test\UI\Responder\Auth;

use App\UI\Responder\Auth\ApiResponder;
use App\UI\Responder\Auth\Interfaces\ApiResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * final Class ApiResponderUnitTest.
 */
final class ApiResponderUnitTest extends TestCase
{
    /**
     * @var null|TokenStorageInterface
     */
    private $tokenStorage = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $responder = new ApiResponder($this->tokenStorage);

        static::assertInstanceOf(ApiResponderInterface::class, $responder);
    }

    /**
     * test if response is returned
     */
    public function testResponseIsReturned()
    {
        $tokenMock = $this->createMock(TokenInterface::class);
        $userMock = $this->createMock(UserInterface::class);

        $tokenMock->method('getUser')->willReturn($userMock);
        $this->tokenStorage->method('getToken')->willReturn($tokenMock);

        $responder = new ApiResponder($this->tokenStorage);

        static::assertInstanceOf(Response::class, $responder());
    }
}
