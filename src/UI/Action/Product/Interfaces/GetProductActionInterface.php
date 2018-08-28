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
use App\UI\Responder\Product\Interfaces\GetProductResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface GetProductActionInterface.
 */
interface GetProductActionInterface
{

    /**
     * GetProductActionInterface constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository);

    /**
     * @param Request $request
     * @param GetProductResponderInterface $getProductResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        GetProductResponderInterface $getProductResponder
    ): Response;
}
