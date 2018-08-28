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

use App\UI\Responder\Product\AddProductResponder;
use App\UI\Responder\Product\Interfaces\AddProductResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class AddProductResponderUnitTest.
 */
final class AddProductResponderUnitTest extends TestCase
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
     * test AddProductResponder
     */
    public function testAddProductResponder()
    {
        $addProductResponder = new AddProductResponder();

        static::assertInstanceOf(AddProductResponderInterface::class, $addProductResponder);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $responder = new AddProductResponder();

        static::assertInstanceOf(Response::class, $responder($this->request));

    }
}
