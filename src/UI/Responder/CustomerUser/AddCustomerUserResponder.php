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

namespace App\UI\Responder\CustomerUser;

use App\UI\Responder\CustomerUser\Interfaces\AddCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class AddCustomerUserResponder.
 */
final class AddCustomerUserResponder implements AddCustomerUserResponderInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(Request $request, $statusCode = Response::HTTP_CREATED, $errors = null): Response
    {
        if ($statusCode === Response::HTTP_SEE_OTHER) {
            return new JsonResponse('CustomerUser already added!', Response::HTTP_SEE_OTHER);
        }

        if (!\is_null($errors)) {
            $errorList = [];
            foreach ($errors as $error) {
                $errorList[] = $error->getMessage();
            }

            return new JsonResponse($errorList, Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE);
        }

        return new JsonResponse('CustomerUser added !', $statusCode);

    }
}
