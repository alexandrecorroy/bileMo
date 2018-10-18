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
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

/**
 * final Class ListProductAction.
 *
 * @Route("api/products", name="product_list", methods={"GET"})
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
     *
     * List of products.
     *
     * You can list all products and her details.
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="no products found"
     * )
     * @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     type="string",
     *     default="Bearer TOKEN",
     *     description="Authorization"
     *)
     *@SWG\Response(
     *     response=401,
     *     description="Expired JWT Token | JWT Token not found | Invalid JWT Token",
     *)
     * @SWG\Tag(
     *     name="API"
     *     )
     *
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        ListProductResponderInterface $listProductResponder,
        NotFoundProductResponderInterface $notFoundProductResponder
    ): Response {
        $products = $this->productRepository->findAllProducts();

        if(\is_null($products)) {
            return $notFoundProductResponder();
        }

        return $listProductResponder($request, $products);
    }
}
