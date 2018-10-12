<?php

declare(strict_types=1);

/**
 * BileMo Project
 *
 * (c) CORROY Alexandre <alexandre.corroy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use App\Entity\Interfaces\AdminInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Admin.
 */
class Admin implements AdminInterface, UserInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $uid;

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
     * Admin constructor.
     *
     * @param $username
     * @param $password
     * @param $email
     *
     * @throws \Exception
     */
    public function __construct(
        $username,
        $password,
        $email
    ) {
        $this->uid      = Uuid::uuid4();
        $this->username = $username;
        $this->password = $password;
        $this->email    = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {

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
    public function getUid(): UuidInterface
    {
        return $this->uid;
    }

    public function updatePassword($password): void
    {
        $this->password = $password;
    }

}
