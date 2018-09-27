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

namespace App\UI\Responder\CustomerUser\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface UpdateCustomerUserResponderInterface.
 */
interface UpdateCustomerUserResponderInterface
{
    /**
     * @param Request $request
     * @param null $errors
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        $errors = null
    ): Response;
}
