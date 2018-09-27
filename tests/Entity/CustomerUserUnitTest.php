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

use App\Entity\CustomerUser;
use App\Entity\Interfaces\CustomerInterface;
use App\Entity\Interfaces\CustomerUserInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

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

    /**
     * unit test add customer user
     */
    public function testAddCustomerUser()
    {
        $customerUser = new CustomerUser(
            "paul",
            "mike",
            "paulmike@test.fr",
            "1048 baker street",
            "56233",
            "0123456789"
        );

        static ::assertInstanceOf(UuidInterface::class, $customerUser->getUid());
        static ::assertInstanceOf(CustomerUserInterface::class, $customerUser);
        static::assertEquals("0123456789", $customerUser->getPhone());
        static::assertEquals("paulmike@test.fr", $customerUser->getEmail());
        static::assertEquals("paul", $customerUser->getName());
        static::assertEquals("mike", $customerUser->getFirstName());
        static::assertEquals("1048 baker street", $customerUser->getAddress());
        static::assertEquals("56233", $customerUser->getZip());
    }
}
