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
use App\UI\Action\Product\DeleteProductAction;
use App\UI\Action\Product\Interfaces\DeleteProductActionInterface;
use App\UI\Responder\Product\Interfaces\DeleteProductResponderInterface;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class DeleteProductActionUnitTest.
 */
final class DeleteProductActionUnitTest extends TestCase
{
    /**
     * @var EntityManagerInterface|null
     */
    private $entityManager = null;

    /**
     * @var ProductRepositoryInterface|null
     */
    private $productRepository = null;

    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * @var DeleteProductResponderInterface|null
     */
    private $responder = null;

    /**
     * @var NotFoundProductResponderInterface|null
     */
    private $notFoundProductResponder = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->responder = $this->createMock(DeleteProductResponderInterface::class);
        $this->notFoundProductResponder = $this->createMock(NotFoundProductResponderInterface::class);

        $request = Request::create('/', 'DELETE');
        $this->request = $request->duplicate(null, null, ['id' => 1]);

    }

    /**
     * test DeleteProductAction
     */
    public function testDeleteProductAction()
    {
        $deleteProductAction = new DeleteProductAction($this->entityManager, $this->productRepository);

        static::assertInstanceOf(DeleteProductActionInterface::class, $deleteProductAction);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $productMock = $this->createMock(ProductInterface::class);

        $this->productRepository->method('findOneByUuidField')->willReturn($productMock);

        $action = new DeleteProductAction($this->entityManager, $this->productRepository);

        static::assertInstanceOf(Response::class, $action($this->request, $this->responder, $this->notFoundProductResponder));
    }
}
