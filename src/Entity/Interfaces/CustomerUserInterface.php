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

use App\Entity\Customer;
use App\Entity\Product;
use Ramsey\Uuid\Uuid;

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
     * @return array
     */
    public function getProducts(): array;

    /**
     * @return Uuid
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
    public function getCustomer(): Customer;

    /**
     * @param array $customerUser
     */
    public function updateCustomer(array $customerUser): void;
}
