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


use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\NotFoundCustomerUserResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class NotFoundCustomerUserResponderUnitTest.
 */
final class NotFoundCustomerUserResponderUnitTest extends TestCase
{
    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $responder = new NotFoundCustomerUserResponder();

        static::assertInstanceOf(NotFoundCustomerUserResponderInterface::class, $responder);
    }

    /**
     * test response is returned
     */
    public function testResponseIsReturned()
    {
        $responder = new NotFoundCustomerUserResponder();

        static::assertInstanceOf(Response::class, $responder());
    }
}
