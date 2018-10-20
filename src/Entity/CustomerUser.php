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
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 56,
     *      minMessage = "CustomerUser name must be at least {{ limit }} characters long",
     *      maxMessage = "CustomerUser name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 56,
     *      minMessage = "FirstName must be at least {{ limit }} characters long",
     *      maxMessage = "FirstName cannot be longer than {{ limit }} characters"
     * )
     */
    private $firstName;

    /**
     * @var string
     * @Assert\Email(
     *     message="Please enter a valid email."
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Email must be at least {{ limit }} characters long",
     *      maxMessage = "Email cannot be longer than {{ limit }} characters"
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 10,
     *      max = 128,
     *      minMessage = "Address must be at least {{ limit }} characters long",
     *      maxMessage = "Address cannot be longer than {{ limit }} characters"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 6,
     *      minMessage = "Zip code must be at least {{ limit }} characters long",
     *      maxMessage = "Zip code name cannot be longer than {{ limit }} characters"
     * )
     */
    private $zip;

    /**
     * @var null|string
     *
     * @Assert\Length(
     *      min = 8,
     *      max = 12,
     *      minMessage = "Phone number must be at least {{ limit }} characters long",
     *      maxMessage = "Phone number name cannot be longer than {{ limit }} characters"
     * )
     *
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
     * @param $name
     * @param $firstName
     * @param $email
     * @param $address
     * @param $zip
     * @param null $phone
     *
     * @throws \Exception
     */
    public function __construct(
        $name,
        $firstName,
        $email,
        $address,
        $zip,
        $phone = null
    ) {
        $this->uid       = Uuid::uuid4();
        $this->name      = $name;
        $this->firstName = $firstName;
        $this->email     = $email;
        $this->address   = $address;
        $this->zip       = $zip;
        $this->phone     = $phone;

        $this->products  = [];
    }

    /**
     * {@inheritdoc}
     */
    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function getZip(): string
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

    /**
     * {@inheritdoc}
     */
    public function setCustomer(Customer $customer): void
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
    public function addLinks(array $links): void
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
    public function deleteProducts(): void
    {
        $this->products = [];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'uid'       => $this->uid,
            'name'      => $this->name,
            'firstName' => $this->firstName,
            'email'     => $this->email,
            'address'   => $this->address,
            'zip'       => $this->zip,
            'phone'     => $this->phone,
            'products'  => $this->getProducts(),
            '_links'    => $this->getLinks(),
            '_embedded' => [
                'customer' => $this->customer
            ]
        ];
    }
}
