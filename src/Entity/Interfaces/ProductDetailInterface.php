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

/**
 * Interface ProductDetailInterface
 */
interface ProductDetailInterface
{
    /**
     * @return int
     */
    public function getUid();

    /**
     * @return string
     */
    public function getBrand(): ?string;

    /**
     * @return string
     */
    public function getColor(): ?string;

    /**
     * @return float
     */
    public function getScreenSize();

    /**
     * @return string
     */
    public function getOs(): ?string;

    /**
     * @return int
     */
    public function getMemory(): ?int;

    /**
     * @return float
     */
    public function getWeight();

    /**
     * @return float
     */
    public function getHeight();

    /**
     * @return float
     */
    public function getWidth();

    /**
     * @return float
     */
    public function getThickness();
}
