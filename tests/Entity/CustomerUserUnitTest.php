<?php

declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Entity\CustomerUser;
use App\Entity\Interfaces\CustomerInterface;
use PHPUnit\Framework\TestCase;

/**
 * final Class CustomerUserUnitTest.
 */
final class CustomerUserUnitTest extends TestCase
{
    /**
     * @var CustomerInterface|null
     */
    private $customer = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->customer = $this->createMock(CustomerInterface::class);
    }

    public function testAddCustomerUser()
    {
        $customerUser = new CustomerUser(
            "paul",
            "mike",
            "paulmike@test.fr",
            "1048 baker street",
            "56233",
            $this->customer,
            "0123456789"
        );

        static::assertEquals("0123456789", $customerUser->getPhone());
        static::assertEquals("paulmike@test.fr", $customerUser->getEmail());
        static::assertEquals("paul", $customerUser->getName());
        static::assertEquals("mike", $customerUser->getFirstName());
        static::assertEquals("1048 baker street", $customerUser->getAddress());
        static::assertEquals("56233", $customerUser->getZip());
    }
}