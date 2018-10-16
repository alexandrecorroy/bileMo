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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
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
     * @param ProductRepositoryInterface $productRepository
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param RouterInterface $router
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        RouterInterface $router
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
