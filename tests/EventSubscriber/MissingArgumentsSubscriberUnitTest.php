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

use App\EventSubscriber\Interfaces\MissingArgumentsSubscriberInterface;
use App\EventSubscriber\MissingArgumentsSubscriber;
use App\Service\Interfaces\ReturnBlankParameterNameInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class MissingArgumentsSubscriberUnitTest.
 */
final class MissingArgumentsSubscriberUnitTest extends TestCase
{
    /**
     * @var ReturnBlankParameterNameInterface|null
     */
    private $returnBlankParameterName = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->returnBlankParameterName = $this->createMock(ReturnBlankParameterNameInterface::class);
    }

    /**
     * test ProductSubscriber
     */
    public function testProductSubscriber()
    {
        $productSubscriber = new MissingArgumentsSubscriber($this->returnBlankParameterName);

        static::assertInstanceOf(EventSubscriberInterface::class, $productSubscriber);
        static::assertInstanceOf(MissingArgumentsSubscriberInterface::class, $productSubscriber);
    }

}
