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
use App\UI\Responder\Product\GetProductResponder;
use App\UI\Responder\Product\Interfaces\GetProductResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class GetProductResponderUnitTest.
 */
final class GetProductResponderUnitTest extends TestCase
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
     * test GetProductResponder
     */
    public function testGetProductResponder()
    {
        $getProductResponder = new GetProductResponder();

        static::assertInstanceOf(GetProductResponderInterface::class, $getProductResponder);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $responder = new GetProductResponder();

        $productMock = $this->createMock(ProductInterface::class);

        static::assertInstanceOf(Response::class, $responder($this->request, $productMock));
    }
}
