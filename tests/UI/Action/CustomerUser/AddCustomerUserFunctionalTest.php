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

namespace App\Test\UI\Action\CustomerUser;

use App\Tests\DataFixtures\DataFixtureTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AddCustomerUserFunctionalTest.
 */
final class AddCustomerUserFunctionalTest extends DataFixtureTestCase
{
    /**
     * test add new CustomerUser
     */
    public function testAddCustomerUser()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', 'api/products');

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $products = [];
        foreach ($data as $product)
        {
            $products[]['uid'] = $product['uid'];
        }

        $array = [
            'name'      => 'Charles',
            'firstName' => "Leroy",
            'email'     => "letest@gmail.com",
            'address'   => "58 rue charles gaulois - St Petersbourg",
            'zip'       => "58445",
            'phone'     => "0599886633",
            'products'  => $products
        ];


        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('POST', 'api/customerUser', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
        static::assertTrue($this->client->getResponse()->headers->has('Location'));;
    }

    /**
     * test add CustomerUser already Exist
     */
    public function testAddCustomerUserAlreadyExist()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', 'api/products');

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $products = [];
        foreach ($data as $product)
        {
            $products[]['uid'] = $product['uid'];
        }

        $array = [
            'name'      => 'Goal',
            'firstName' => "Paul",
            'email'     => "goal.paul@gmail.com",
            'address'   => "58 rue charles gaulois - St Petersbourg",
            'zip'       => "58445",
            'phone'     => "0599886633",
            'products'  => $products
        ];

        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('POST', 'api/customerUser', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_SEE_OTHER, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }

    /**
     * test add CustomerUser Without One Parameter
     */
    public function testAddCustomerUserWithoutOneParameter()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', 'api/products');

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $products = [];
        foreach ($data as $product)
        {
            $products[]['uid'] = $product['uid'];
        }

        $array = [
            'name'      => 'Charles',
            'firstName' => "Leroy",
            'address'   => "58 rue charles gaulois - St Petersbourg",
            'zip'       => "58445",
            'phone'     => "0599886633",
            'products'  => $products
        ];


        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('POST', 'api/customerUser', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }

    /**
     * test add CustomerUser With bad assert
     */
    public function testAddCustomerUserWithBadAssert()
    {
        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('GET', 'api/products');

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $products = [];
        foreach ($data as $product)
        {
            $products[]['uid'] = $product['uid'];
        }

        $array = [
            'name'      => 'A Very Very Very Very Very Very Very Very Very Very Very Very Very Very Very Very Very Very Very Very Long Name !',
            'firstName' => "Leroy",
            'email'     => "letest@gmail.com",
            'address'   => "58 rue charles gaulois - St Petersbourg",
            'zip'       => "58445",
            'phone'     => "0599886633",
            'products'  => $products
        ];

        $json = json_encode($array);

        $this->client = self::createAuthenticatedRoleUser();
        $this->client->request('POST', 'api/customerUser', array(), array(), array(), $json);

        static::assertEquals(Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, $this->client->getResponse()->getStatusCode());
        static::assertTrue($this->client->getResponse()->headers->contains('content-type', 'application/json'));;
    }
}
