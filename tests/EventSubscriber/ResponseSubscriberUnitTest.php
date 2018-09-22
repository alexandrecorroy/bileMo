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

namespace App\Tests\EventSubscriber;


use App\EventSubscriber\Interfaces\ResponseSubscriberInterface;
use App\EventSubscriber\ResponseSubscriber;
use PHPUnit\Framework\TestCase;

/**
 * final Class ResponseSubscriberUnitTest.
 */
final class ResponseSubscriberUnitTest extends TestCase
{
    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        static::assertInstanceOf(ResponseSubscriberInterface::class, new ResponseSubscriber());
    }
}
