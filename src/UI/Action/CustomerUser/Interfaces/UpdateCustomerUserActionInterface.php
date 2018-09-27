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
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\UpdateCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface UpdateCustomerUserActionInterface.
 */
interface UpdateCustomerUserActionInterface
{
    /**
     * UpdateCustomerUserActionInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param CustomerUserRepositoryInterface $customerUserRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerUserRepositoryInterface $customerUserRepository,
        ValidatorInterface $validator
    );

    /**
     * @param Request $request
     * @param UpdateCustomerUserResponderInterface $updateCustomerUserResponder
     * @param NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        UpdateCustomerUserResponderInterface $updateCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response;
}
