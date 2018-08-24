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
use App\UI\Action\Product\Interfaces\UpdateProductActionInterface;
use App\UI\Action\Product\UpdateProductAction;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class UpdateProductActionUnitTest.
 */
final class UpdateProductActionUnitTest extends TestCase
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
        $this->validator = static::createMock(ValidatorInterface::class);
    }

    /**
     * test UpdateProductAction
     */
    public function testAddProductAction()
    {
        $updateProductAction = new UpdateProductAction($this->entityManager, $this->productRepository, $this->validator);

        static::assertInstanceOf(UpdateProductActionInterface::class, $updateProductAction);
    }
}
