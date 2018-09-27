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


use App\Entity\Customer;
use App\Entity\CustomerUser;
use Doctrine\Common\Cache\ApcuCache;
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
     * @param ApcuCache $cache
     */
    public function __construct(RegistryInterface $registry, ApcuCache $cache);

    /**
     * @return CustomerUser|null
     */
    public function getOneCustomer(): ?Customer;
}
