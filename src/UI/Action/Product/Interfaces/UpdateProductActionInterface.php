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
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use App\UI\Responder\Product\Interfaces\UpdateProductResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface UpdateProductActionInterface.
 */
interface UpdateProductActionInterface
{

    /**
     * UpdateProductActionInterface constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ValidatorInterface $validator
    );

    /**
     * @param Request $request
     * @param UpdateProductResponderInterface $updateProductResponder
     * @param NotFoundProductResponderInterface $notFoundProductResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        UpdateProductResponderInterface $updateProductResponder,
        NotFoundProductResponderInterface $notFoundProductResponder
    ): Response;
}
