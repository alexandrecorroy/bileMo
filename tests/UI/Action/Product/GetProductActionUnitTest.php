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
use App\UI\Action\Product\GetProductAction;
use App\UI\Action\Product\Interfaces\GetProductActionInterface;
use PHPUnit\Framework\TestCase;

/**
 * final Class GetProductActionUnitTest.
 */
final class GetProductActionUnitTest extends TestCase
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->productRepository = static::createMock(ProductRepositoryInterface::class);
    }

    /**
     * Test GetProductAction
     */
    public function testGetProductAction()
    {
        $getProductAction = new GetProductAction($this->productRepository);

        static::assertInstanceOf(GetProductActionInterface::class, $getProductAction);
    }
}
