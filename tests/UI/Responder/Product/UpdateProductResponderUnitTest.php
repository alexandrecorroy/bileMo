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

use App\UI\Responder\Product\Interfaces\UpdateProductResponderInterface;
use App\UI\Responder\Product\UpdateProductResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class UpdateProductResponderUnitTest.
 */
final class UpdateProductResponderUnitTest extends TestCase
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
     * test UpdateProductResponder
     */
    public function testUpdateProductResponder()
    {
        $updateProductResponder = new UpdateProductResponder();

        static::assertInstanceOf(UpdateProductResponderInterface::class, $updateProductResponder);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $responder = new UpdateProductResponder();

        static::assertInstanceOf(Response::class, $responder($this->request));
    }


}
