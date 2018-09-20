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

namespace App\Service\Interfaces;

/**
 * Interface ReturnBlankParameterNameInterface.
 */
interface ReturnBlankParameterNameInterface
{
    /**
     * @param $string
     * @return string
     */
    public function returnParameter($string);
}
