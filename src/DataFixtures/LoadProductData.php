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


use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * final Class LoadProductData.
 */
final class LoadProductData extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $product = new Product(
            'Note 9',
            1099.90,
            $this->getReference('detail_note9')
        );

        $product2 = new Product(
            'S9',
            990.90,
            $this->getReference('detail_s9')
        );

        $product3 = new Product(
            'iPhone X',
            1199.99,
            $this->getReference('detail_iphonex')
        );

        $manager->persist($product);
        $manager->persist($product2);
        $manager->persist($product3);

        $manager->flush();

        $this->addReference('p_note9', $product);
        $this->addReference('p_s9', $product2);
        $this->addReference('p_iphonex', $product3);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            LoadProductDetailData::class
        );
    }
}
