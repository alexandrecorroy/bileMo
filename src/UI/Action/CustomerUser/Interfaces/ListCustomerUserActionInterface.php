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
use App\UI\Responder\CustomerUser\Interfaces\ListCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ListCustomerUserActionInterface.
 */
interface ListCustomerUserActionInterface
{
    /**
     * ListCustomerUserActionInterface constructor.
     *
     * @param CustomerUserRepositoryInterface $customerUserRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        CustomerUserRepositoryInterface $customerUserRepository,
        EntityManagerInterface $entityManager
    );

    /**
     * @param Request $request
     * @param ListCustomerUserResponderInterface $listCustomerUserResponder
     * @param NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        ListCustomerUserResponderInterface $listCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response;
}
