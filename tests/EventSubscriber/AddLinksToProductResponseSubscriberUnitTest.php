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

use App\EventSubscriber\AddLinksToProductResponseSubscriber;
use App\EventSubscriber\Interfaces\AddLinksToProductResponseSubscriberInterface;
use App\EventSubscriber\Interfaces\ProductSubscriberInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class AddLinksToProductResponseSubscriberUnitTest.
 */
final class AddLinksToProductResponseSubscriberUnitTest extends TestCase
{
    /**
     * @var SerializerInterface|null
     */
    private $serializer = null;

    /**
     * @var UrlGeneratorInterface|null
     */
    private $urlGenerator = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    }

    /**
     * test AddLinksToProductResponseSubscriber
     */
    public function testAddLinksToProductResponseSubscriber()
    {
        $subscriber = new AddLinksToProductResponseSubscriber($this->serializer, $this->urlGenerator);

        static::assertInstanceOf(EventSubscriberInterface::class, $subscriber);
        static::assertInstanceOf(AddLinksToProductResponseSubscriberInterface::class, $subscriber);
    }

}
