<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/07/2018
 * Time: 09:40
 */
declare(strict_types = 1);

namespace App\Entity\Interfaces;

/**
 * Interface CustomerInterface
 */
interface CustomerInterface
{
    /**
     * @return int
     */
    public function getUid();

    /**
     * @return string
     */
    public function getSociety(): ?string;

    /**
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * @return string
     */
    public function getUsername(): ?string;

    /**
     * @return string
     */
    public function getPassword(): ?string;

    /**
     * @return null|string
     */
    public function getPhone(): ?string;
}
