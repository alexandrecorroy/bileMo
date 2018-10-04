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
use App\UI\Responder\CustomerUser\Interfaces\DeleteCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\ForbiddenCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Interface DeleteCustomerUserActionInterface.
 */
interface DeleteCustomerUserActionInterface
{

    /**
     * DeleteCustomerUserActionInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param CustomerUserRepositoryInterface $customerUserRepository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerUserRepositoryInterface $customerUserRepository,
        TokenStorageInterface $tokenStorage
    );

    /**
     * @param Request $request
     * @param DeleteCustomerUserResponderInterface $deleteCustomerUserResponder
     * @param NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
     * @param ForbiddenCustomerUserResponderInterface $forbiddenCustomerUserResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        DeleteCustomerUserResponderInterface $deleteCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder,
        ForbiddenCustomerUserResponderInterface $forbiddenCustomerUserResponder
    ): Response;

}
