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

use App\Entity\ProductDetail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * final Class LoadProductDetailData.
 */
final class LoadProductDetailData extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $productDetail = new ProductDetail(
            'Samsung',
            'Noir Carbone',
            'Android Oreo',
            128,
            201.8,
            6.4,
            161.9,
            76.4,
            8.8
        );

        $productDetail2 = new ProductDetail(
            'Samsung',
            'Bleu Corail',
            'Android Oreo',
            64,
            163.0,
            5.8,
            147.7,
            68.7,
            8.5
        );

        $productDetail3 = new ProductDetail(
            'Apple',
            'Gris sidéral',
            'iOs 11',
            64,
            174,
            5.8,
            143.6,
            70.9,
            7.7
        );

        $manager->persist($productDetail);
        $manager->persist($productDetail2);
        $manager->persist($productDetail3);

        $manager->flush();

        $this->addReference('detail_note9', $productDetail);
        $this->addReference('detail_s9', $productDetail2);
        $this->addReference('detail_iphonex', $productDetail3);
    }

}
