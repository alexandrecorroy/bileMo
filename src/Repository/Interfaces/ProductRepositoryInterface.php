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

use App\Entity\Interfaces\ProductInterface;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Interface ProductRepositoryInterface.
 */
interface ProductRepositoryInterface
{
    /**
     * ProductRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     * @param ApcuCache $cache
     */
    public function __construct(ManagerRegistry $registry, ApcuCache $cache);

    /**
     * @param $value
     *
     * @return ProductInterface|null
     */
    public function findOneByUuidField($value): ?ProductInterface;

    /**
     * @return array|null
     */
    public function findAllProducts(): array ;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface|null
     */
    public function findOtherProduct(ProductInterface $product): ?ProductInterface;

    /**
     * @param $entity
     */
    public function create($entity): void;

    /**
     * @param $entity
     */
    public function delete($entity): void;

    /**
     * save to bdd
     */
    public function save(): void;
}
