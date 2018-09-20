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

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * final Class LoadCustomerData.
 */
final class LoadCustomerData extends Fixture
{

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $customer = new Customer(
            'SFR',
            'contact@sfr.fr',
            'sfr',
            'sfr',
            '0184563355'
        );

        $manager->persist($customer);
        $manager->flush();

        $this->addReference('sfr', $customer);

    }

}
