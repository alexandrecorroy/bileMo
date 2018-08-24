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

use App\UI\Action\Product\DeleteProductAction;
use App\UI\Action\Product\Interfaces\DeleteProductActionInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

/**
 * final Class DeleteProductActionUnitTest.
 */
final class DeleteProductActionUnitTest extends TestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->entityManager = static::createMock(EntityManagerInterface::class);
    }

    /**
     * Test DeleteProductAction
     */
    public function testDeleteProductAction()
    {
        $deleteProductAction = new DeleteProductAction($this->entityManager);

        static::assertInstanceOf(DeleteProductActionInterface::class, $deleteProductAction);
    }
}
