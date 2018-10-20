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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * final Class LoadCustomerData.
 */
final class LoadCustomerData extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * LoadCustomerData constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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

        $encoded = $this->encoder->encodePassword($customer, $customer->getPassword());

        $customer->updatePassword($encoded);

        $manager->persist($customer);

        $customer2 = new Customer(
            'Free',
            'contact@free.fr',
            'free',
            'free',
            '0125886699'
        );

        $encoded = $this->encoder->encodePassword($customer2, $customer2->getPassword());
        $customer2->updatePassword($encoded);
        $manager->persist($customer2);

        $manager->flush();

        $this->addReference('sfr', $customer);

    }

}
