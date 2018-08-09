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

namespace App\Repository\Interfaces;

use App\Entity\Interfaces\ProductInterface;

interface ProductRepositoryInterface
{
    public function findOneByUuidField($value): ?ProductInterface;

    public function findAllProducts();
}
