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

use App\UI\Responder\Auth\Interfaces\RegisterResponderInterface;
use App\UI\Responder\Auth\RegisterResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class RegisterResponderUnitTest.
 */
final class RegisterResponderUnitTest extends TestCase
{
    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $class = new RegisterResponder();

        static::assertInstanceOf(RegisterResponderInterface::class, $class);
    }

    /**
     * test if response is returned
     */
    public function testResponseIsReturned()
    {
        $class = new RegisterResponder();

        static::assertInstanceOf(Response::class, $class());
    }

}
