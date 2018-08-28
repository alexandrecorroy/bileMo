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

namespace App\Tests\UI\Responder\Product;

use App\Entity\Interfaces\ProductInterface;
use App\UI\Responder\Product\Interfaces\ListProductResponderInterface;
use App\UI\Responder\Product\ListProductResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class ListProductResponderUnitTest.
 */
final class ListProductResponderUnitTest extends TestCase
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
     * test ListProductResponder
     */
    public function testListProductResponder()
    {
        $listProductResponder = new ListProductResponder();

        static::assertInstanceOf(ListProductResponderInterface::class, $listProductResponder);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $responder = new ListProductResponder();

        $productsMock[] = $this->createMock(ProductInterface::class);

        static::assertInstanceOf(Response::class, $responder($this->request, $productsMock));
    }
}
