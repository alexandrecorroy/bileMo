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

use App\UI\Responder\Product\Interfaces\AddProductResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class AddProductResponder.
 */
final class AddProductResponder implements AddProductResponderInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(Request $request, $errors): Response
    {
        if (!is_null($errors)) {
            if ($errors === Response::HTTP_SEE_OTHER) {
                return new JsonResponse('Product already added!', Response::HTTP_SEE_OTHER);
            } else {
                $errorList = [];
                foreach ($errors as $error) {
                    array_push($errorList, $error->getMessage());
                }

                return new JsonResponse($errorList, Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE);
            }
        } else {
            return new JsonResponse('Product Added !', Response::HTTP_CREATED);
        }
    }
}
