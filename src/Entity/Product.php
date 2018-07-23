<?php
declare(strict_types = 1);

namespace App\Entity;

use App\Entity\Interfaces\ProductInterface;
use Ramsey\Uuid\Uuid;

/**
 * final Class Product
 */
final class Product implements ProductInterface
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
     * Product constructor.
     * @param string $name
     * @param float $price
     */
    public function __construct(
        string $name,
        float $price
    ) {
        $this->uid = Uuid::uuid4();
        $this->name = $name;
        $this->price = $price;
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
}
