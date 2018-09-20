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

namespace App\UI\Action\CustomerUser\Interfaces;

use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Responder\CustomerUser\Interfaces\GetCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface GetCustomerUserActionInterface.
 */
interface GetCustomerUserActionInterface
{
    /**
     * GetCustomerUserActionInterface constructor.
     *
     * @param CustomerUserRepositoryInterface $customerUserRepository
     */
    public function __construct(CustomerUserRepositoryInterface $customerUserRepository);

    /**
     * @param Request $request
     * @param GetCustomerUserResponderInterface $getCustomerUserResponder
     * @param NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        GetCustomerUserResponderInterface $getCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response;

}
