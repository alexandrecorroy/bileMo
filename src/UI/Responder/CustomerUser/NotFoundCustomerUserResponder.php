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

use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * final Class NotFoundCustomerUserResponder.
 */
final class NotFoundCustomerUserResponder implements NotFoundCustomerUserResponderInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(): Response
    {
        return new JsonResponse('Customer user not found', Response::HTTP_NOT_FOUND);
    }
}
