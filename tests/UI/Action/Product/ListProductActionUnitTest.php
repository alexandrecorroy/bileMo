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

namespace App\Tests\UI\Action\Product;

use App\Entity\Interfaces\ProductInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Action\Product\Interfaces\ListProductActionInterface;
use App\UI\Action\Product\ListProductAction;
use App\UI\Responder\Product\Interfaces\ListProductResponderInterface;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use App\UI\Responder\Product\NotFoundProductResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class ListProductActionUnitTest.
 */
final class ListProductActionUnitTest extends TestCase
{
    /**
     * @var ProductRepositoryInterface|null
     */
    private $productRepository = null;

    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * @var ListProductResponderInterface|null
     */
    private $responder = null;

    /**
     * @var NotFoundProductResponder|null
     */
    private $notFoundProductResponderInterface = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->productRepository                 = $this->createMock(ProductRepositoryInterface::class);
        $request                                 = Request::create('/', 'GET');
        $this->request                           = $request->duplicate(null, null, ['id' => 1]);
        $this->responder                         = $this->createMock(ListProductResponderInterface::class);
        $this->notFoundProductResponderInterface = $this->createMock(NotFoundProductResponderInterface::class);
    }

    /**
     * test ListProductAction
     */
    public function testListProductAction()
    {
        $listProductAction = new ListProductAction($this->productRepository);

        static::assertInstanceOf(ListProductActionInterface::class, $listProductAction);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $productsMock[] = $this->createMock(ProductInterface::class);
        $response = $this->createMock(Response::class);

        $this->productRepository->method('findAllProducts')->willReturn($productsMock);
        $this->responder->method('__invoke')->willReturn($response);

        $action = new ListProductAction($this->productRepository);

        static::assertInstanceOf(Response::class, $action($this->request, $this->responder, $this->notFoundProductResponderInterface));
    }
}
