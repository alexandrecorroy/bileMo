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


use App\EventSubscriber\ProductSubscriber;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ProductSubscriberUnitTest.
 */
class ProductSubscriberUnitTest extends TestCase
{

    /**
     * test ProductSubscriber
     */
    public function testProductSubscriber()
    {
        $productSubscriber = new ProductSubscriber();

        static::assertInstanceOf(EventSubscriberInterface::class, $productSubscriber);
    }

}
