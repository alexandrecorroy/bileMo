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

use Ramsey\Uuid\UuidInterface;

/**
 * Interface ProductInterface
 */
interface ProductInterface
{
    /**
     * @return UuidInterface
     */
    public function getUid(): UuidInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return ProductDetailInterface
     */
    public function getProductDetail(): ProductDetailInterface;

    /**
     * @param array $product
     */
    public function updateProduct(array $product): void;

    /**
     * @return array
     */
    public function getLinks(): array;

    /**
     * @param array $links
     */
    public function addLinks(array $links): void;
}
