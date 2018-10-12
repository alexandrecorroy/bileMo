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
use App\UI\Action\Product\AddProductAction;
use App\UI\Action\Product\Interfaces\AddProductActionInterface;
use App\UI\Responder\Product\Interfaces\AddProductResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class AddProductActionUnitTest.
 */
final class AddProductActionUnitTest extends TestCase
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
     * @var SerializerInterface|null
     */
    private $serializer = null;

    /**
     * @var ValidatorInterface|null
     */
    private $validator = null;

    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * @var AddProductResponderInterface|null
     */
    private $responder = null;

    /**
     * @var RouterInterface|null
     */
    private $router = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->entityManager     = $this->createMock(EntityManagerInterface::class);
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $this->serializer        = $this->createMock(SerializerInterface::class);
        $this->validator         = $this->createMock(ValidatorInterface::class);
        $this->responder         = $this->createMock(AddProductResponderInterface::class);
        $this->router            = $this->createMock(RouterInterface::class);

        $request = Request::create('/', 'POST');
        $this->request = $request->duplicate(null, null);
    }

    /**
     * test AddProductAction
     */
    public function testAddProductAction()
    {
        $addProductAction = new AddProductAction(
            $this->entityManager,
            $this->productRepository,
            $this->serializer,
            $this->validator,
            $this->router
        );

        static::assertInstanceOf(AddProductActionInterface::class, $addProductAction);
    }

    /**
     * test response
     */
    public function testResponseIsReturned()
    {
        $productMock = $this->createMock(ProductInterface::class);

        $this->serializer->method('deserialize')->willReturn($productMock);
        $this->validator->method('validate')->willReturn([]);

        $action = new AddProductAction(
            $this->entityManager,
            $this->productRepository,
            $this->serializer,
            $this->validator,
            $this->router
        );

        static::assertInstanceOf(Response::class, $action($this->request, $this->responder));
    }

}
