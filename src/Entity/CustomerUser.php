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

use App\Entity\Interfaces\CustomerInterface;
use App\Entity\Interfaces\CustomerUserInterface;
use App\Entity\Interfaces\ProductInterface;
use Ramsey\Uuid\Uuid;

/**
 * final Class CustomerUser.
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
     * @var ProductInterface[]
     */
    private $products = [];

    /**
     * @var CustomerInterface
     */
    private $customer;


    /**
     * CustomerUser constructor.
     *
     * @param string            $name name of customer
     * @param string            $firstName firstname of customer
     * @param string            $email customer's email
     * @param string            $address customer's address
     * @param string            $zip zip code
     * @param CustomerInterface $customer society which has sold the phone
     * @param string|null       $phone customer's phone
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

        $this->products = [];
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
