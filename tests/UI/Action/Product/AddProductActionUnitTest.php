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

use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Action\Product\AddProductAction;
use App\UI\Action\Product\Interfaces\AddProductActionInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class AddProductActionUnitTest.
 */
final class AddProductActionUnitTest extends TestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->entityManager = static::createMock(EntityManagerInterface::class);
        $this->productRepository = static::createMock(ProductRepositoryInterface::class);
        $this->serializer = static::createMock(SerializerInterface::class);
        $this->validator = static::createMock(ValidatorInterface::class);
    }

    /**
     * test AddProductAction
     */
    public function testAddProductAction()
    {
        $addProductAction = new AddProductAction($this->entityManager, $this->productRepository, $this->serializer, $this->validator);

        static::assertInstanceOf(AddProductActionInterface::class, $addProductAction);
    }
}
