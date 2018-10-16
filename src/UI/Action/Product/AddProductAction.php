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
