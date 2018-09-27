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
use App\Entity\Interfaces\CustomerUserInterface;
use Doctrine\Common\Cache\ApcuCache;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Interface CustomerUserRepositoryInterface.
 */
interface CustomerUserRepositoryInterface
{
    /**
     * CustomerUserRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     * @param ApcuCache $cache
     */
    public function __construct(RegistryInterface $registry, ApcuCache $cache);

    /**
     * @param $value
     *
     * @return CustomerUserInterface|null
     */
    public function findOneByUuidField($value): ?CustomerUserInterface;

    /**
     * @param Customer $customer
     * @return array|null
     */
    public function findAllCustomerUser(Customer $customer): ?array ;

    /**
     * @param CustomerUserInterface $customerUser
     * @return CustomerUserInterface|null
     */
    public function findOtherCustomerUser(CustomerUserInterface $customerUser): ?CustomerUserInterface ;
}
