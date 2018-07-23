<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/07/2018
 * Time: 09:41
 */
declare(strict_types = 1);

namespace App\Entity\Interfaces;

/**
 * Interface ProductDetailInterface
 */

use App\Entity\Product;

/**
 * Interface ProductDetailInterface
 * @package App\Entity\Interfaces
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

    /**
     * @return Product
     */
    public function getProduct();
}
