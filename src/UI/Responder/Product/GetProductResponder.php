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

namespace App\UI\Responder\Product;

use App\Entity\Interfaces\ProductInterface;
use App\UI\Responder\Product\Interfaces\GetProductResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class GetProductResponder.
 */
final class GetProductResponder implements GetProductResponderInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        ProductInterface $product
    ): Response {
        return new JsonResponse($product);
    }
}
