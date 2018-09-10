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


use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class NotFoundProductResponder implements NotFoundProductResponderInterface
{

    /**
     * {@inheritdoc}
     */
    public function __invoke(): Response
    {
        return new JsonResponse('Product(s) not found', Response::HTTP_NOT_FOUND);
    }

}