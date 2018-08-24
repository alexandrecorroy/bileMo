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
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Interface ProductRepositoryInterface.
 */
interface ProductRepositoryInterface
{
    /**
     * ProductRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param $value
     *
     * @return ProductInterface|null
     */
    public function findOneByUuidField($value): ?ProductInterface;

    /**
     * @return array
     */
    public function findAllProducts(): array ;

    /**
     * @param ProductInterface $product
     *
     * @return ProductInterface|null
     */
    public function findOtherProduct(ProductInterface $product): ?ProductInterface ;
}
