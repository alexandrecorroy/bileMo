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

namespace App\Test\Entity;

use App\Entity\Admin;
use App\Entity\Interfaces\AdminInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

/**
 * final Class AdminUnitTest.
 */
final class AdminUnitTest extends TestCase
{
    /**
     * unit test add a new admin
     */
    public function testAddAdmin()
    {
        $admin = new Admin(
            "admin",
            "admin_password",
            "admin@test.fr"
        );

        static::assertInstanceOf(AdminInterface::class, $admin);
        static::assertInstanceOf(UuidInterface::class, $admin->getUid());
        static::assertEquals("admin@test.fr", $admin->getEmail());
        static::assertEquals("admin_password", $admin->getPassword());
        static::assertEquals("admin", $admin->getUsername());
    }
}
