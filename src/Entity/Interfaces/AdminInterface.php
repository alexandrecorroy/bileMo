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

namespace App\Entity\Interfaces;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface AdminInterface.
 */
interface AdminInterface
{
    /**
     * @return UuidInterface
     */
    public function  getUid(): UuidInterface;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param $password
     */
    public function updatePassword($password): void;
}
