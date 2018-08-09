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

use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Action\Product\Interfaces\ListProductActionInterface;
use App\UI\Responder\Product\Interfaces\ListProductResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * final Class ListProductAction.
 *
 * @Route("/product/list", name="product_list", methods={"GET"})
 */
final class ListProductAction implements ListProductActionInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * {@inheritdoc}
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(Request $request, ListProductResponderInterface $listProductResponder): Response
    {
        $product = $this->productRepository->findAllProducts();

        return $listProductResponder($request, $product);
    }
}
