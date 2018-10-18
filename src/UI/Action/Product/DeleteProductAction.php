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
use App\UI\Action\Product\Interfaces\DeleteProductActionInterface;
use App\UI\Responder\Product\Interfaces\DeleteProductResponderInterface;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

/**
 * final Class DeleteProductAction.
 *
 * @Route("api/product/{id}", name="product_delete", methods={"DELETE"})
 */
final class DeleteProductAction implements DeleteProductActionInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $productRepository;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     *
     * Delete a product.
     *
     * You can Delete a product and his detail.
     *
     * @SWG\Response(
     *     response=202,
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
     *     dataType="string",
     *     description="uid of product",
     *     required=true
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
        DeleteProductResponderInterface $deleteProductResponder,
        NotFoundProductResponderInterface $notFoundProductResponder
    ): Response {

        $cache = new ApcuCache();
        $product = $this->productRepository->findOneByUuidField($request->get("id"));

        if(\is_null($product))
        {
            return $notFoundProductResponder();
        }

        $cache->delete('find'.$product->getUid()->toString());
        $cache->delete('find_all_products');
        $this->productRepository->delete($product);

        return $deleteProductResponder($request);
    }
}
