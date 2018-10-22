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
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Action\Product\Interfaces\AddProductActionInterface;
use App\UI\Responder\Product\Interfaces\AddProductResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Swagger\Annotations as SWG;

/**
 * final Class AddProductAction.
 *
 * @Route("api/product", name="product_add", methods={"POST"})
 */
final class AddProductAction implements AddProductActionInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        RouterInterface $router
    ) {
        $this->productRepository = $productRepository;
        $this->serializer        = $serializer;
        $this->validator         = $validator;
        $this->router            = $router;
    }

    /**
     *
     * Add a new product.
     *
     * You can add a new product and his detail.
     *
     * @SWG\Response(
     *     response=201,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=303,
     *     description="When resources already exist"
     * )
     * @SWG\Response(
     *     response=416,
     *     description="When Range not satisfiable"
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
     *                      @SWG\Property(property="brand", type="string", example="Samsung"),
     *                      @SWG\Property(property="color", type="string", example="red"),
     *                      @SWG\Property(property="os", type="string", example="Android Oreo"),
     *                      @SWG\Property(property="memory", type="integer", example="128"),
     *                      @SWG\Property(property="weight",  type="number", format="float", example="154.8"),
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
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        AddProductResponderInterface $addProductResponder
    ): Response {
        $cache = new ApcuCache();

        $data = $request->getContent();

        $product = $this->serializer->deserialize($data, Product::class, 'json');


        $errors = $this->validator->validate($product);

        if (\count($errors) > 0) {
            return $addProductResponder(null, $errors);
        }

        if ($this->productRepository->findOtherProduct($product)) {
            return $addProductResponder(null, Response::HTTP_SEE_OTHER);
        }

        $cache->delete('find_all_products');
        $this->productRepository->create($product);

        return $addProductResponder($this->router->generate('product_show', ['id' => $product->getUid()->toString()]));
    }
}
