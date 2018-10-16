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

namespace App\Repository\Interfaces;

use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Interface CustomerRepositoryInterface.
 */
interface CustomerRepositoryInterface
{
    /**
     * CustomerRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(
        RegistryInterface $registry
    );

    /**
     * @param $entity
     */
    public function create($entity): void;

    /**
     * save to bdd
     */
    public function save(): void;
}
