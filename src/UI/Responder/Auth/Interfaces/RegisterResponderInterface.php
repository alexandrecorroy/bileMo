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

namespace App\UI\Responder\Auth\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface RegisterResponderInterface
{
    /**
     * @param int $statusCode
     * @param null $errors
     *
     * @return Response
     */
    public function __invoke(
        $statusCode = Response::HTTP_CREATED,
        $errors = null
    ): Response;
}