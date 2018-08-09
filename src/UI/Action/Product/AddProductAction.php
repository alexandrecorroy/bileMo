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

namespace App\UI\Action\Product;

use App\Entity\Product;
use App\Entity\ProductDetail;
use App\UI\Action\Product\Interfaces\AddProductActionInterface;
use App\UI\Responder\Product\Interfaces\AddProductResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * final Class AddProductAction.
 *
 * @Route("/product/add", name="product_add", methods={"POST"})
 */
final class AddProductAction implements AddProductActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(Request $request, AddProductResponderInterface $addProductResponder): Response
    {
        $array = json_decode($request->getContent(), true);

        $productDetail = new ProductDetail(
            $array['brand'],
            $array['color'],
            $array['os'],
            intval($array['memory']),
            floatval($array['weight']),
            floatval($array['screenSize']),
            floatval($array['height']),
            floatval($array['width']),
            floatval($array['thickness'])
        );

        $product = new Product(
            $array['name'],
            floatval($array['price']),
            $productDetail
        );

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $addProductResponder($request);
    }
}
