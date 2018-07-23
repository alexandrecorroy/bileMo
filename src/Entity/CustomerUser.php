<?php
declare(strict_types = 1);

namespace App\Entity;

use App\Entity\Interfaces\CustomerInterface;
use App\Entity\Interfaces\CustomerUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

/**
 * final Class CustomerUser
 */
final class CustomerUser implements CustomerUserInterface
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
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $zip;
    /**
     * @var null|string
     */
    private $phone;
    /**
     * @var ArrayCollection
     */
    private $products;
    /**
     * @var Customer
     */
    private $customer;


    /**
     * CustomerUser constructor.
     * @param string $name
     * @param string $firstName
     * @param string $email
     * @param string $address
     * @param string $zip
     * @param CustomerInterface $customer
     * @param string|null $phone
     */
    public function __construct(
        string $name,
        string $firstName,
        string $email,
        string $address,
        string $zip,
        CustomerInterface $customer,
        string $phone = null
    ) {
        $this->uid = Uuid::uuid4();
        $this->name = $name;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->address = $address;
        $this->zip = $zip;
        $this->phone = $phone;
        $this->customer = $customer;

        $this->products = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addProduct(Product $product)
    {
        $this->products->add($product);
    }

    /**
     * {@inheritdoc}
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts()
    {
        return $this->products;
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
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
