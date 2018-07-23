<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/2018
 * Time: 16:26
 */
declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Entity\Customer;
use App\Entity\Interfaces\CustomerInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * final Class CustomerUnitTest
 */
final class CustomerUnitTest extends TestCase
{
    public function testAddCustomer()
    {
        $customer = new Customer(
            "societest",
            "test@test.fr",
            "user",
            "password",
            "0123456789"
        );

        static::assertInstanceOf(CustomerInterface::class, $customer);
        static::assertInstanceOf(UuidInterface::class, $customer->getUid());
        static::assertEquals("test@test.fr", $customer->getEmail());
        static::assertEquals("password", $customer->getPassword());
        static::assertEquals("user", $customer->getUsername());
        static::assertEquals("0123456789", $customer->getPhone());
        static::assertEquals("societest", $customer->getSociety());
    }
}
