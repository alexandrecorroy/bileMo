<?php
declare(strict_types = 1);

namespace App\Entity;

use App\Entity\Interfaces\CustomerInterface;
use Ramsey\Uuid\Uuid;

/**
 * final Class Customer
 */
final class Customer implements CustomerInterface
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
    private $phone;

    /**
     * Customer constructor.
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
}
