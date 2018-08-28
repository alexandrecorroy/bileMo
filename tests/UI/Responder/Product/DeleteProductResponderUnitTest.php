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

use App\UI\Responder\Product\DeleteProductResponder;
use App\UI\Responder\Product\Interfaces\DeleteProductResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class DeleteProductResponderUnitTest.
 */
final class DeleteProductResponderUnitTest extends TestCase
{
    /**
     * @var Request|null
     */
    private $request = null;

    public function setUp()
    {
        $this->request = $this->createMock(Request::class);
    }

    /**
     * test DeleteProductResponder
     */
    public function testDeleteProductResponder()
    {
        $deleteProductResponder = new DeleteProductResponder();

        static::assertInstanceOf(DeleteProductResponderInterface::class, $deleteProductResponder);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {

        $responder = new DeleteProductResponder();

        static::assertInstanceOf(Response::class, $responder($this->request));

    }
}
