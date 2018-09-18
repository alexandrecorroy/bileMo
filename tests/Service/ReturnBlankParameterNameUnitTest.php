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

namespace App\Tests\Service;


use App\Service\Interfaces\ReturnBlankParameterNameInterface;
use App\Service\ReturnBlankParameterName;
use PHPUnit\Framework\TestCase;

/**
 * final Class ReturnBlankParameterNameUnitTest.
 */
final class ReturnBlankParameterNameUnitTest extends TestCase
{
    /**
     * test return parameter
     */
    public function testReturnParam()
    {
        $string = 'Cannot create an instance of App\\Entity\\Product from serialized data because its constructor requires parameter "price" to be present.';
        $class = new ReturnBlankParameterName();
        $param = $class->returnParameter($string);

        static::assertInstanceOf(ReturnBlankParameterNameInterface::class, $class);
        static::assertSame('Price', $param);
    }
}