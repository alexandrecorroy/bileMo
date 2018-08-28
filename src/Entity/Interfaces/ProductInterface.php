<?php

declare(strict_types = 1);

/**
 * BileMo Project
 *
 * (c) CORROY Alexandre <alexandre.corroy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity\Interfaces;

use App\Entity\ProductDetail;

/**
 * Interface ProductInterface
 */
interface ProductInterface
{
    /**
     * @return int
     */
    public function getUid();

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @return float
     */
    public function getPrice();

    /**
     * @return ProductDetail
     */
    public function getProductDetail();

    /**
     * @param array $product
     *
     * @return mixed
     */
    public function updateProduct(array $product);
}
