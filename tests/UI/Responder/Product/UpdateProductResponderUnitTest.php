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

use App\UI\Responder\Product\Interfaces\UpdateProductResponderInterface;
use App\UI\Responder\Product\UpdateProductResponder;
use PHPUnit\Framework\TestCase;

/**
 * final Class UpdateProductResponderUnitTest.
 */
final class UpdateProductResponderUnitTest extends TestCase
{

    /**
     * test UpdateProductResponder
     */
    public function testUpdateProductResponder()
    {
        $updateProductResponder = new UpdateProductResponder();

        static::assertInstanceOf(UpdateProductResponderInterface::class, $updateProductResponder);
    }
}
