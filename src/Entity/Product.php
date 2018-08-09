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

namespace App\Entity;

use App\Entity\Interfaces\ProductDetailInterface;
use App\Entity\Interfaces\ProductInterface;
use Ramsey\Uuid\Uuid;

/**
 * final Class Product.
 */
final class Product implements ProductInterface, \JsonSerializable
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $uid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var ProductDetailInterface
     */
    private $productDetail;

    /**
     * Product constructor.
     *
     * @param string $name
     * @param float $price
     * @param ProductDetailInterface $productDetail
     * @throws \Exception
     */
    public function __construct(
        string $name,
        float $price,
        ProductDetailInterface $productDetail
    ) {
        $this->uid = Uuid::uuid4();
        $this->name = $name;
        $this->price = $price;
        $this->productDetail = $productDetail;
    }

    /**
     * {@inheritdoc}
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'uid'   => $this->getUid(),
            'name'  => $this->getName(),
            'price' => $this->getPrice()
        ];
    }

    /**
     * @return ProductDetailInterface
     */
    public function getProductDetail(): ProductDetailInterface
    {
        return $this->productDetail;
    }
}
