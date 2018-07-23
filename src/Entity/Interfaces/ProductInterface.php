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
}
