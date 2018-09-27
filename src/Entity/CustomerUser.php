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

use App\Entity\Interfaces\CustomerUserInterface;
use App\Entity\Interfaces\ProductInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class CustomerUser.
 */
class CustomerUser implements CustomerUserInterface, \JsonSerializable
{
    /**
     * @var UuidInterface
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
     * @var Customer
     */
    private $customer;

    /**
     * @var array
     */
    private $links = [];


    /**
     * CustomerUser constructor.
     *
     * @param string $name
     * @param string $firstName
     * @param string $email
     * @param string $address
     * @param string $zip
     * @param Customer $customer
     * @param string|null $phone
     */
    public function __construct(
        string $name,
        string $firstName,
        string $email,
        string $address,
        string $zip,
        string $phone = null
    ) {
        $this->uid = Uuid::uuid4();
        $this->name = $name;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->address = $address;
        $this->zip = $zip;
        $this->phone = $phone;

        $this->products = [];
    }

    /**
     * {@inheritdoc}
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function removeProduct(Product $product)
    {
        $productUid = $product->getUid();
        foreach ($this->products as $product)
        {
            if($product->getUid() === $productUid)
                unset($product);
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts(): array
    {
        $list = [];
        foreach ($this->products as $product)
        {
            $list[] = $product;
        }
        return $list;
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
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
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
    public function addLinks(array $links)
    {
        $this->links[] = $links;
    }

    /**
     * {@inheritdoc}
     */
    public function updateCustomer(array $customerUser): void
    {
        foreach ($customerUser as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'uid' => $this->uid,
            'name' => $this->name,
            'firstName' => $this->firstName,
            'email' => $this->email,
            'address' => $this->address,
            'zip' => $this->zip,
            'phone' => $this->phone,
            'products' => $this->getProducts(),
            '_links' => $this->getLinks(),
            '_embedded' => [
                'customer' => $this->customer
            ]
        ];
    }

}
