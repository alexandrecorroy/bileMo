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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class AddProductAction.
 *
 * @Route("/product", name="product_add", methods={"POST"})
 */
final class AddProductAction implements AddProductActionInterface
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
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ProductRepositoryInterface $productRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->entityManager     = $entityManager;
        $this->productRepository = $productRepository;
        $this->serializer        = $serializer;
        $this->validator         = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
                             AddProductResponderInterface $addProductResponder
    ): Response {
        $data = $request->getContent();

        $product = $this->serializer->deserialize($data, Product::class, 'json');


        $errors = $this->validator->validate($product);

        if (\count($errors) > 0) {
            return $addProductResponder($request, $errors);
        }

        if ($this->productRepository->findOtherProduct($product)) {
            return $addProductResponder($request, Response::HTTP_SEE_OTHER);
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $addProductResponder($request, null);
    }
}
