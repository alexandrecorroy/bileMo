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
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Product.
 */
class Product implements ProductInterface, \JsonSerializable
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $uid;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 56,
     *      minMessage = "Product name must be at least {{ limit }} characters long",
     *      maxMessage = "Product name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @var float
     *
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $price;

    /**
     * @var ProductDetailInterface
     *
     * @Assert\Valid()
     */
    private $productDetail;

    /**
     * @var array
     */
    private $links = [];

    /**
     * Product constructor.
     *
     * @param $name
     * @param $price
     * @param ProductDetail $productDetail
     *
     * @throws \Exception
     */
    public function __construct(
        $name,
        $price,
        ProductDetail $productDetail
    ) {
        $this->uid           = Uuid::uuid4();
        $this->name          = $name;
        $this->price         = $price;
        $this->productDetail = $productDetail;
    }

    /**
     * {@inheritdoc}
     */
    public function addLinks(array $links): void
    {
        $this->links[] = $links;
    }

    /**
     * {@inheritdoc}
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * {@inheritdoc}
     */
    public function getUid(): UuidInterface
    {
        return $this->uid;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [

            'uid'           => $this->uid,
            'name'          => $this->name,
            'price'         => $this->price,
            'productDetail' => $this->productDetail,
            '_links'        => $this->getLinks()

        ];
    }

    /**
     * @return ProductDetailInterface
     */
    public function getProductDetail(): ProductDetailInterface
    {
        return $this->productDetail;
    }

    /**
     * @param array $product
     */
    public function updateProduct(array $product): void
    {
        foreach ($product as $key => $value) {
            if (property_exists(self::class, $key) && $key!='productDetail') {
                $this->$key = $value;
            }
        }
    }
}
