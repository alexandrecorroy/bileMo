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
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ProductDetail.
 */
class ProductDetail implements ProductDetailInterface, \JsonSerializable
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
     *      minMessage = "Brand must be at least {{ limit }} characters long",
     *      maxMessage = "Brand cannot be longer than {{ limit }} characters"
     * )
     */
    private $brand;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 32,
     *      minMessage = "Color must be at least {{ limit }} characters long",
     *      maxMessage = "Color cannot be longer than {{ limit }} characters"
     * )
     */
    private $color;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 56,
     *      minMessage = "Os must be at least {{ limit }} characters long",
     *      maxMessage = "Os cannot be longer than {{ limit }} characters"
     * )
     */
    private $os;

    /**
     * @var int
     *
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $memory;

    /**
     * @var float
     *
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $weight;

    /**
     * @var float
     *
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $screenSize;

    /**
     * @var float
     *
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $height;

    /**
     * @var float
     *
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $width;

    /**
     * @var float
     *
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $thickness;

    /**
     * ProductDetail constructor.
     *
     * @param string $brand
     * @param string $color
     * @param string $os
     * @param int $memory
     * @param float $weight
     * @param float $screenSize
     * @param float $height
     * @param float $width
     * @param float $thickness
     * @throws \Exception
     */
    public function __construct(
        $brand,
        $color,
        $os,
        $memory,
        $weight,
        $screenSize,
        $height,
        $width,
        $thickness
    ) {
        $this->uid = Uuid::uuid4();
        $this->brand = $brand;
        $this->color = $color;
        $this->os = $os;
        $this->memory = $memory;
        $this->weight = $weight;
        $this->screenSize = $screenSize;
        $this->height = $height;
        $this->width = $width;
        $this->thickness = $thickness;
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
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * {@inheritdoc}
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * {@inheritdoc}
     */
    public function getOs(): ?string
    {
        return $this->os;
    }

    /**
     * {@inheritdoc}
     */
    public function getMemory(): ?int
    {
        return $this->memory;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * {@inheritdoc}
     */
    public function getScreenSize()
    {
        return $this->screenSize;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function getThickness()
    {
        return $this->thickness;
    }

    /**
     * @param array $productDetail
     */
    public function updateProductDetail(array $productDetail)
    {
        foreach ($productDetail as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function jsonSerialize()
    {
        return [
            'brand'   => $this->getBrand(),
            'color'  => $this->getColor(),
            'os' => $this->getOs(),
            'memory' => $this->getMemory(),
            'weight' => $this->getWeight(),
            'screenSize' => $this->getScreenSize(),
            'height' => $this->getHeight(),
            'width' => $this->getWidth(),
            'thickness' => $this->getThickness()
        ];
    }
}
