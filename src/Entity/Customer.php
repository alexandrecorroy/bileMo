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
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Customer.
 */
class Customer implements CustomerInterface, \JsonSerializable, UserInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $uid;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 56,
     *      minMessage = "Society's name must be at least {{ limit }} characters long",
     *      maxMessage = "Society's name be longer than {{ limit }} characters"
     * )
     *
     */
    private $society;

    /**
     * @var string
     *
     * @Assert\Email()
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Email must be at least {{ limit }} characters long",
     *      maxMessage = "Email cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 56,
     *      minMessage = "Username must be at least {{ limit }} characters long",
     *      maxMessage = "Username cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var null|string
     *
     * @Assert\Length(
     *      min = 8,
     *      max = 12,
     *      minMessage = "Phone must be at least {{ limit }} characters long",
     *      maxMessage = "Phone cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $phone = null;

    /**
     * @var CustomerUser[]
     */
    private $customerUsers = [];

    /**
     * Customer constructor.
     *
     * @param $society
     * @param $email
     * @param $username
     * @param $password
     * @param null $phone
     *
     * @throws \Exception
     */
    public function __construct(
        $society,
        $email,
        $username,
        $password,
        $phone = null
    ) {
        $this->uid           = Uuid::uuid4();
        $this->society       = $society;
        $this->email         = $email;
        $this->username      = $username;
        $this->password      = $password;
        $this->phone         = $phone;
        $this->customerUsers = [];
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
    public function getSociety(): string
    {
        return $this->society;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword(): string
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
    public function addCustomerUser(CustomerUser $customerUser): void
    {
        $customerUser->setCustomer($this);
        $this->customerUsers[] = $customerUser;
    }

    /**
     * {@inheritdoc}
     */
    public function removeCustomerUser(CustomerUser $customerUser): void
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
    public function getCustomerUsers(): array
    {
        $list = [];
        foreach ($this->customerUsers as $customerUser)
        {
            $list[] = $customerUser;
        }
        return $list;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'uid'      => $this->uid,
            'society'  => $this->society,
            'email'    => $this->email,
            'username' => $this->username,
            'phone'    => $this->phone
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function updatePassword($password): void
    {
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {

    }
}
