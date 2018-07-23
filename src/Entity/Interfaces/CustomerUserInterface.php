<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/07/2018
 * Time: 09:41
 */
declare(strict_types = 1);

namespace App\Entity\Interfaces;

use App\Entity\Customer;
use App\Entity\Product;
use Doctrine\Common\Collections\Collection;

/**
 * Interface CustomerUserInterface
 */
interface CustomerUserInterface
{
    /**
     * @param Product $product
     * @return null
     */
    public function addProduct(Product $product);

    /**
     * @param Product $product
     * @return null
     */
    public function removeProduct(Product $product);

    /**
     * @return Collection
     */
    public function getProducts();

    /**
     * @return int
     */
    public function getUid();

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @return string
     */
    public function getFirstName(): ?string;

    /**
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * @return string
     */
    public function getAddress(): ?string;

    /**
     * @return string
     */
    public function getZip(): ?string;

    /**
     * @return null|string
     */
    public function getPhone(): ?string;

    /**
     * @return Customer
     */
    public function getCustomer();
}
