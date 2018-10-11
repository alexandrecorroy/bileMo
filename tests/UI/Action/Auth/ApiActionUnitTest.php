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


use App\UI\Action\Auth\ApiAction;
use App\UI\Action\Auth\Interfaces\ApiActionInterface;
use App\UI\Responder\Auth\Interfaces\ApiResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class ApiActionUnitTest.
 */
final class ApiActionUnitTest extends TestCase
{
    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $api = new ApiAction();

        static::assertInstanceOf(ApiActionInterface::class, $api);
    }

    /**
     * test if response is returned
     */
    public function testResponseIsReturned()
    {
        $api = new ApiAction();
        $apiResponder = $this->createMock(ApiResponderInterface::class);

        static::assertInstanceOf(Response::class, $api($apiResponder));
    }
}
