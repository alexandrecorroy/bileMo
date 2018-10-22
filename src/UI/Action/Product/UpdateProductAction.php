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
use App\UI\Action\Product\Interfaces\UpdateProductActionInterface;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use App\UI\Responder\Product\Interfaces\UpdateProductResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Swagger\Annotations as SWG;

/**
 * final Class UpdateProductAction.
 *
 * @Route("api/product/{id}", name="product_update", methods={"PATCH"})
 */
final class UpdateProductAction implements UpdateProductActionInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     *{@inheritdoc}
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ValidatorInterface $validator
    ) {
        $this->productRepository = $productRepository;
        $this->validator         = $validator;
    }

    /**
     * Update a product.
     *
     * You can update a product and his detail.
     * In Patch method all you will send will be overwritted ! Nothing else.
     *
     * @SWG\Response(
     *     response=202,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Malformed content"
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
     *@SWG\Parameter(
     *     name="body",
     *     in="body",
     *     required=true,
     *     description="json order object",
     *     format="application/json",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="name", type="string", example="Galaxy S9"),
     *         @SWG\Property(property="price", type="number", format="float", example="759.99"),
     *         @SWG\Property(
     *              property="productDetail",
     *              type="array",
     *              @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="brand", type="string", example="Samsung",),
     *                      @SWG\Property(property="color", type="string", example="red"),
     *                      @SWG\Property(property="os", type="string", example="Android Oreo"),
     *                      @SWG\Property(property="memory", type="integer", example="128"),
     *                      @SWG\Property(property="weight", type="number", format="float", example="154.8"),
     *                      @SWG\Property(property="screenSize",  type="number", format="float", example="5.9"),
     *                      @SWG\Property(property="height",  type="number", format="float", example="167.8"),
     *                      @SWG\Property(property="width",  type="number", format="float", example="88.4"),
     *                      @SWG\Property(property="thickness",  type="number", format="float", example="7.7")
     *              ))
     *
     *)
     *)
     *@SWG\Response(
     *     response=401,
     *     description="Expired JWT Token | JWT Token not found | Invalid JWT Token",
     *)
     *@SWG\Response(
     *     response=403,
     *     description="Not Authorized",
     *)
     * @SWG\Tag(
     *     name="Administration"
     *     )
     *
     *{@inheritdoc}
     */
    public function __invoke(
        Request $request,
        UpdateProductResponderInterface $updateProductResponder,
        NotFoundProductResponderInterface $notFoundProductResponder
    ): Response {
        $cache = new ApcuCache();

        $array = \json_decode($request->getContent(), true);

        $product = $this->productRepository->findOneByUuidField($request->attributes->get('id'));

        if (\is_null($product)) {
            return $notFoundProductResponder();
        }

        $productDetail = $product->getProductDetail();
        $productDetail->updateProductDetail($array["productDetail"]);

        $array['productDetail'] = $productDetail;
        $product->updateProduct($array);

        $errors = $this->validator->validate($product);

        if (\count($errors) > 0) {
            return $updateProductResponder($request, $errors);
        }

        $cache->delete('find'.$product->getUid()->toString());
        $cache->delete('find_all_products');
        $this->productRepository->save();

        return $updateProductResponder($request);
    }
}
