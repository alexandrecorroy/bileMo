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
 * Interface ProductDetailInterface
 */
interface ProductDetailInterface
{
    /**
     * @return UuidInterface
     */
    public function getUid(): UuidInterface;

    /**
     * @return string
     */
    public function getBrand(): string;

    /**
     * @return string
     */
    public function getColor(): string;

    /**
     * @return float
     */
    public function getScreenSize(): float;

    /**
     * @return string
     */
    public function getOs(): string;

    /**
     * @return int
     */
    public function getMemory(): int;

    /**
     * @return float
     */
    public function getWeight(): float;

    /**
     * @return float
     */
    public function getHeight(): float;

    /**
     * @return float
     */
    public function getWidth(): float;

    /**
     * @return float
     */
    public function getThickness(): float;

    /**
     * @param array|null $productDetail
     */
    public function updateProductDetail(array $productDetail = null): void;
}
