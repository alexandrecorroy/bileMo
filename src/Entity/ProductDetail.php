<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductDetailRepository")
 * @ORM\Table(name="bilemo_product_detail")
 */
class ProductDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="id")
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=56)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=56)
     */
    private $os;

    /**
     * @ORM\Column(type="smallint")
     */
    private $memory;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $weight;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=1)
     */
    private $screenSize;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=1)
     */
    private $height;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1)
     */
    private $width;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1)
     */
    private $thickness;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="product", referencedColumnName="id", nullable=false)
     */
    private $product;

    public function getUid()
    {
        return $this->uid;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function setOs(string $os): self
    {
        $this->os = $os;

        return $this;
    }

    public function getMemory(): ?int
    {
        return $this->memory;
    }

    public function setMemory(int $memory): self
    {
        $this->memory = $memory;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getScreenSize()
    {
        return $this->screenSize;
    }

    public function setScreenSize($screenSize): self
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getThickness()
    {
        return $this->thickness;
    }

    public function setThickness($thickness): self
    {
        $this->thickness = $thickness;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }


}
