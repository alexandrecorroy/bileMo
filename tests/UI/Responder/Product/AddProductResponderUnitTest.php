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

use App\UI\Responder\Product\AddProductResponder;
use App\UI\Responder\Product\Interfaces\AddProductResponderInterface;
use PHPUnit\Framework\TestCase;

/**
 * final Class AddProductResponderUnitTest.
 */
final class AddProductResponderUnitTest extends TestCase
{

    /**
     * test AddProductResponder
     */
    public function testAddProductResponder()
    {
        $addProductResponder = new AddProductResponder();

        static::assertInstanceOf(AddProductResponderInterface::class, $addProductResponder);
    }
}
