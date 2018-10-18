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
use App\UI\Action\Product\Interfaces\GetProductActionInterface;
use App\UI\Responder\Product\Interfaces\GetProductResponderInterface;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

/**
 * final Class GetProductAction.
 *
 * @Route("api/product/{id}", name="product_show", methods={"GET"})
 */
final class GetProductAction implements GetProductActionInterface
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
     * get a product.
     *
     * get product and his detail.
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="product not found"
     * )
     * @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     type="string",
     *     default="Bearer TOKEN",
     *     description="Authorization"
     *)
     *@SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     required=true,
     *     description="uid of product"
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
        GetProductResponderInterface $getProductResponder,
        NotFoundProductResponderInterface $notFoundProductResponder
    ): Response {
        $product = $this->productRepository->findOneByUuidField($request->attributes->get('id'));

        if(\is_null($product)) {
            return $notFoundProductResponder();
        }

        return $getProductResponder($request, $product);
    }
}
