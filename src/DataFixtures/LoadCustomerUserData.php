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

use App\Entity\CustomerUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * final Class LoadCustomerUserData.
 */
final class LoadCustomerUserData extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $customerUser1 = new CustomerUser(
            'Greytup',
            'Audrey',
            'greytup.audrey@gmail.com',
            '97 rue de la chaussée ',
            '58740',
            $this->getReference('sfr'),
            '0147586633'
        );

        $customerUser2 = new CustomerUser(
            'Goal',
            'Paul',
            'goal.paul@gmail.com',
            '78 rue de paris',
            '54760',
            $this->getReference('sfr'),
            '0155889966'
        );

        $customerUser1->addProduct($this->getReference('p_note9'));
        $customerUser1->addProduct($this->getReference('p_s9'));
        $customerUser2->addProduct($this->getReference('p_iphonex'));


        $manager->persist($customerUser1);
        $manager->persist($customerUser2);

        $manager->flush();

        $this->addReference('user1', $customerUser1);
        $this->addReference('user2', $customerUser2);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            LoadCustomerData::class,
            LoadProductData::class
        );
    }

}
