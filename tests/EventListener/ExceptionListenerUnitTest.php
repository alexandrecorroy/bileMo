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

namespace App\Test\EventListener;

use App\EventListener\ExceptionListener;
use App\EventListener\Interfaces\ExceptionListenerInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ExceptionListenerUnitTest.
 */
final class ExceptionListenerUnitTest extends TestCase
{
    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $class = new ExceptionListener();

        static::assertInstanceOf(ExceptionListenerInterface::class, $class);
    }
}
