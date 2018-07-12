<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/2018
 * Time: 16:26
 */

namespace App\Tests\Entity;


use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class CustomerTest extends TestCase
{
    public function initCustomer()
    {
        $customer = new Customer();
        $customer->setEmail("test@test.fr")
            ->setPassword("password")
            ->setUsername("user")
            ->setPhone("0123456789")
            ->setSociety("societest");

        return $customer;
    }

    public function testAddCustomer()
    {
        $customer = $this::initCustomer();

        $this->assertEquals("test@test.fr", $customer->getEmail());
        $this->assertEquals("password", $customer->getPassword());
        $this->assertEquals("user", $customer->getUsername());
        $this->assertEquals("0123456789", $customer->getPhone());
        $this->assertEquals("societest", $customer->getSociety());

    }

}