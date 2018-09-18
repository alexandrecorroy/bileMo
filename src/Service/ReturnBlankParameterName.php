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

namespace App\Service;

use App\Service\Interfaces\ReturnBlankParameterNameInterface;

/**
 * final Class ReturnBlankParameterName.
 */
final class ReturnBlankParameterName implements ReturnBlankParameterNameInterface
{
    /**
     * {@inheritdoc}
     */
    public function returnParameter($string)
    {
        $param = substr($string, strpos($string, ' "')+2, (strpos($string, '" '))-(\strlen($string)));
        return ucfirst($param);
    }

}
