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

use App\UI\Responder\CustomerUser\Interfaces\UpdateCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class UpdateCustomerUserResponder.
 */
final class UpdateCustomerUserResponder implements UpdateCustomerUserResponderInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        $errors = null
    ): Response {
        if (!\is_null($errors) && \is_array($errors)) {

            $errorList = [];
            foreach ($errors as $error) {
                array_push($errorList, $error->getMessage());
            }

            return new JsonResponse($errorList, Response::HTTP_BAD_REQUEST);

        } else {

            return new JsonResponse('CustomerUser Updated !', Response::HTTP_NO_CONTENT);
        }
    }
}
