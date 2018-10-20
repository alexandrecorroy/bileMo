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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class UpdateProductAction.
 *
 * @Route("api/product/{id}", name="product_update", methods={"PATCH"})
 */
final class UpdateProductAction implements UpdateProductActionInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

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
        EntityManagerInterface $entityManager,
        ProductRepositoryInterface $productRepository,
        ValidatorInterface $validator
    ) {
        $this->entityManager     = $entityManager;
        $this->productRepository = $productRepository;
        $this->validator         = $validator;
    }

    /**
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
        $this->entityManager->flush();

        return $updateProductResponder($request);
    }
}
