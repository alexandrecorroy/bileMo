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
use Ramsey\Uuid\Uuid;

/**
 * Class Customer.
 */
class Customer implements CustomerInterface, \JsonSerializable
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $uid;

    /**
     * @var string
     */
    private $society;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var null|string
     */
    private $phone = null;

    private $customerUsers = [];

    /**
     * Customer constructor.
     *
     * @param string $society
     * @param string $email
     * @param string $username
     * @param string $password
     * @param string|null $phone
     */
    public function __construct(
        string $society,
        string $email,
        string $username,
        string $password,
        string $phone = null
    ) {
        $this->uid = Uuid::uuid4();
        $this->society = $society;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->phone = $phone;

        $this->customerUsers = [];
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
    public function getSociety(): ?string
    {
        return $this->society;
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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword(): ?string
    {
        return $this->password;
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
    public function addCustomerUser(CustomerUser $customerUser)
    {
        $customerUser->setCustomer($this);
        $this->customerUsers[] = $customerUser;
    }

    /**
     * {@inheritdoc}
     */
    public function removeCustomerUser(CustomerUser $customerUser)
    {
        $customerUserId = $customerUser->getUid();
        foreach ($this->customerUsers as $customerUser)
        {
            if($customerUser->getUid() === $customerUserId)
                unset($customerUser);
            break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerUsers()
    {
        $list = [];
        foreach ($this->customerUsers as $customerUser)
        {
            $list[] = $customerUser;
        }
        return $list;
    }

    public function jsonSerialize()
    {
        return [
            'uid' => $this->uid,
            'society' => $this->society,
            'email' => $this->email,
            'username' => $this->username,
            'phone' => $this->phone
        ];
    }


}
