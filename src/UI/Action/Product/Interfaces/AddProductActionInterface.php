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

namespace App\UI\Action\Product\Interfaces;

use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Responder\Product\Interfaces\AddProductResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface AddProductActionInterface.
 */
interface AddProductActionInterface
{

    /**
     * AddProductActionInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ProductRepositoryInterface $productRepository
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ProductRepositoryInterface $productRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    );

    /**
     * @param Request $request
     * @param AddProductResponderInterface $addProductResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
                             AddProductResponderInterface $addProductResponder
    ): Response;
}
