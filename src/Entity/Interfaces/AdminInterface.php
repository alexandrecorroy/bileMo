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

/**
 * Interface AdminInterface.
 */
interface AdminInterface
{
    /**
     * AdminInterface constructor.
     *
     * @param $username
     * @param $password
     * @param $email
     */
    public function __construct(
        $username,
        $password,
        $email
    );

    /**
     * @return mixed
     */
    public function  getUuid();

    /**
     * @return mixed
     */
    public function getEmail();
}
