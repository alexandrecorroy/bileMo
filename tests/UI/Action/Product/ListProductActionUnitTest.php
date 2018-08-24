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
use App\UI\Action\Product\Interfaces\ListProductActionInterface;
use App\UI\Action\Product\ListProductAction;
use PHPUnit\Framework\TestCase;

/**
 * final Class ListProductActionUnitTest.
 */
final class ListProductActionUnitTest extends TestCase
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
     * Test ListProductAction
     */
    public function testListProductAction()
    {
        $listProductAction = new ListProductAction($this->productRepository);

        static::assertInstanceOf(ListProductActionInterface::class, $listProductAction);
    }
}
