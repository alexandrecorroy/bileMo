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

use App\Entity\Interfaces\ProductDetailInterface;
use App\Entity\Interfaces\ProductInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Action\Product\Interfaces\UpdateProductActionInterface;
use App\UI\Action\Product\UpdateProductAction;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use App\UI\Responder\Product\Interfaces\UpdateProductResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class UpdateProductActionUnitTest.
 */
final class UpdateProductActionUnitTest extends TestCase
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
     * @var ValidatorInterface|null
     */
    private $validator = null;

    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * @var UpdateProductResponderInterface|null
     */
    private $responder = null;

    /**
     * @var NotFoundProductResponderInterface|null
     */
    private  $notFoundProductResponderInterface = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->entityManager                     = $this->createMock(EntityManagerInterface::class);
        $this->productRepository                 = $this->createMock(ProductRepositoryInterface::class);
        $this->validator                         = $this->createMock(ValidatorInterface::class);
        $this->responder                         = $this->createMock(UpdateProductResponderInterface::class);
        $this->notFoundProductResponderInterface = $this->createMock(NotFoundProductResponderInterface::class);
        $request                                 = Request::create('/', 'PATCH');
        $this->request                           = $request->duplicate(null, null, ['id' => 1]);
    }

    /**
     * test UpdateProductAction
     */
    public function testAddProductAction()
    {
        $updateProductAction = new UpdateProductAction(
            $this->entityManager,
            $this->productRepository,
            $this->validator
        );

        static::assertInstanceOf(UpdateProductActionInterface::class, $updateProductAction);
    }

    /**
     * test response
     */
    public function testResponse()
    {
        $productMock = $this->createMock(ProductInterface::class);
        $productDetailMock = $this->createMock(ProductDetailInterface::class);

        $productMock->method('getProductDetail')->willReturn($productDetailMock);
        $this->productRepository->method('findOneByUuidField')->willReturn($productMock);
        $this->validator->method('validate')->willReturn([]);

        $action = new UpdateProductAction(
            $this->entityManager,
            $this->productRepository,
            $this->validator
        );

        static::assertInstanceOf(Response::class, $action($this->request, $this->responder, $this->notFoundProductResponderInterface));
    }
}
