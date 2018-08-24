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

namespace App\Tests\UI\Responder\Product;

use App\UI\Responder\Product\DeleteProductResponder;
use App\UI\Responder\Product\Interfaces\DeleteProductResponderInterface;
use PHPUnit\Framework\TestCase;

/**
 * final Class DeleteProductResponderUnitTest.
 */
final class DeleteProductResponderUnitTest extends TestCase
{

    /**
     * test DeleteProductResponder
     */
    public function testDeleteProductResponder()
    {
        $deleteProductResponder = new DeleteProductResponder();

        static::assertInstanceOf(DeleteProductResponderInterface::class, $deleteProductResponder);
    }
}
