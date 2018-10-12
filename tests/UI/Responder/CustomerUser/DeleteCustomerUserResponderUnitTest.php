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

use App\UI\Responder\CustomerUser\DeleteCustomerUserResponder;
use App\UI\Responder\CustomerUser\Interfaces\DeleteCustomerUserResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class DeleteCustomerUserResponderUnitTest.
 */
final class DeleteCustomerUserResponderUnitTest extends TestCase
{
    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->request = $this->createMock(Request::class);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $responder = new DeleteCustomerUserResponder();

        static::assertInstanceOf(DeleteCustomerUserResponderInterface::class, $responder);
    }

    /**
     * test response is returned
     */
    public function testResponseIsReturned()
    {
        $responder = new DeleteCustomerUserResponder();

        static::assertInstanceOf(Response::class, $responder($this->request));
    }
}
