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

namespace App\UI\Responder\Auth;

use App\UI\Responder\Auth\Interfaces\RegisterResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class RegisterResponder.
 */
final class RegisterResponder implements RegisterResponderInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(
        $statusCode = Response::HTTP_CREATED,
        $errors = null
    ): Response {
        if(!\is_null($errors))
        {
            $errorList = [];
            foreach ($errors as $error) {
                $errorList[] = $error->getMessage();
            }

            return new JsonResponse($errorList, Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE);
        }

        return new JsonResponse('Customer added !', $statusCode);
    }
}
