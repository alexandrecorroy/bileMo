<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/2018
 * Time: 16:33
 */

namespace App\Tests\Entity;


use App\Entity\CustomerUser;
use PHPUnit\Framework\TestCase;

class CustomerUserTest extends TestCase
{

    public function initCustomerUser()
    {
        $customer = new CustomerTest();
        $customer = $customer->initCustomer();

        $customerUser = new CustomerUser();
        $customerUser->setPhone("0123456789")
            ->setEmail("paulmike@test.fr")
            ->setName("paul")
            ->setFirstName("mike")
            ->setAdress("1048 baker street")
            ->setZip("56233")
            ->setCustomer($customer);

        return $customerUser;
    }

    public function testAddCustomerUser()
    {

        $customerUser = $this::initCustomerUser();

        $this->assertEquals("0123456789", $customerUser->getPhone());
        $this->assertEquals("paulmike@test.fr", $customerUser->getEmail());
        $this->assertEquals("paul", $customerUser->getName());
        $this->assertEquals("mike", $customerUser->getFirstName());
        $this->assertEquals("1048 baker street", $customerUser->getAdress());
        $this->assertEquals("56233", $customerUser->getZip());

    }

    public function testAddProductToCustomerUser()
    {
        $product = new ProductTest();
        $product = $product->initProduct();

        $customerUser = $this::initCustomerUser();

        $customerUser->addProduct($product);

        $products = $customerUser->getProducts();

        $this->assertEquals(189.99, $products[0]->getPrice());
        $this->assertEquals("LG G4", $products[0]->getName());
    }

}