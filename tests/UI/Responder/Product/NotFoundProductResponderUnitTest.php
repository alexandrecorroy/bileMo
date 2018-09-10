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


use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use App\UI\Responder\Product\NotFoundProductResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class NotFoundProductResponderUnitTest.
 */
class NotFoundProductResponderUnitTest extends TestCase
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
        $notFoundProductResponder = new NotFoundProductResponder();

        static::assertInstanceOf(NotFoundProductResponderInterface::class, $notFoundProductResponder);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $notFoundProductResponder = new NotFoundProductResponder();

        static::assertInstanceOf(Response::class, $notFoundProductResponder());
    }

}