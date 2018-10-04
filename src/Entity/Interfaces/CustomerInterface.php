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

use App\Entity\CustomerUser;

/**
 * Interface CustomerInterface
 */
interface CustomerInterface
{
    /**
     * @return int
     */
    public function getUid();

    /**
     * @return string
     */
    public function getSociety(): ?string;

    /**
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * @return string
     */
    public function getUsername(): ?string;

    /**
     * @return string
     */
    public function getPassword(): ?string;

    /**
     * @return null|string
     */
    public function getPhone(): ?string;

    /**
     * @param CustomerUser $customerUser
     */
    public function addCustomerUser(CustomerUser $customerUser): void;
}
