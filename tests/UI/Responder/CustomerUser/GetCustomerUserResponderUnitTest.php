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

namespace App\Tests\UI\Responder\CustomerUser;

use App\Entity\Interfaces\CustomerUserInterface;
use App\UI\Responder\CustomerUser\GetCustomerUserResponder;
use App\UI\Responder\CustomerUser\Interfaces\GetCustomerUserResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class GetCustomerUserResponderUnitTest.
 */
final class GetCustomerUserResponderUnitTest extends TestCase
{
    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * @var CustomerUserInterface|null
     */
    private $customerUser = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->request      = $this->createMock(Request::class);
        $this->customerUser = $this->createMock(CustomerUserInterface::class);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $responder = new GetCustomerUserResponder();

        static::assertInstanceOf(GetCustomerUserResponderInterface::class, $responder);
    }

    /**
     * test response is returned
     */
    public function testResponseIsReturned()
    {
        $responder = new GetCustomerUserResponder();

        static::assertInstanceOf(Response::class, $responder($this->request, $this->customerUser));
    }
}
