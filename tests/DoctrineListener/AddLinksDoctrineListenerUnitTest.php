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

namespace App\Tests\DoctrineListener;


use App\DoctrineListener\AddLinksDoctrineListener;
use App\DoctrineListener\Interfaces\AddLinksDoctrineListenerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AddLinksDoctrineListenerUnitTest.
 */
final class AddLinksDoctrineListenerUnitTest extends TestCase
{

    /**
     * @var UrlGeneratorInterface|null
     */
    private $urlGenerator = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    }

    /**
     * test implement interface
     */
    public function testImplementInterface()
    {
        $this::assertInstanceOf(AddLinksDoctrineListenerInterface::class, new AddLinksDoctrineListener($this->urlGenerator));
    }

}
