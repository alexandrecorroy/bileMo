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
    /**
     * unit test add a new customer
     */
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
