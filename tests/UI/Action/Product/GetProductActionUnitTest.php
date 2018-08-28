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
use App\UI\Action\Product\GetProductAction;
use App\UI\Action\Product\Interfaces\GetProductActionInterface;
use App\UI\Responder\Product\GetProductResponder;
use App\UI\Responder\Product\Interfaces\GetProductResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class GetProductActionUnitTest.
 */
final class GetProductActionUnitTest extends TestCase
{
    /**
     * @var ProductRepositoryInterface|null
     */
    private $productRepository = null;

    /**
     * @var GetProductResponderInterface|null
     */
    private $responder = null;

    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $request = Request::create('/', 'GET');
        $this->request = $request->duplicate(null, null, ['id' => 1]);
        $this->responder = $this->createMock(GetProductResponderInterface::class);
    }

    /**
     * test GetProductAction
     */
    public function testGetProductAction()
    {
        $getProductAction = new GetProductAction($this->productRepository);

        static::assertInstanceOf(GetProductActionInterface::class, $getProductAction);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $productMock = $this->createMock(ProductInterface::class);
        $this->productRepository->method('findOneByUuidField')->willReturn($productMock);

        $response = $this->createMock(Response::class);
        $this->responder->method('__invoke')->willReturn($response);

        $action = new GetProductAction($this->productRepository);

        static::assertInstanceOf(Response::class, $action($this->request, $this->responder));
    }
}
