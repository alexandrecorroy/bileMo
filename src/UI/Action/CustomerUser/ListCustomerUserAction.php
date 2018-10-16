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

namespace App\UI\Action\CustomerUser;

use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Action\CustomerUser\Interfaces\ListCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\ListCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * final Class ListCustomerUserAction.
 *
 * @Route("api/customerUsers", name="customer_user_list", methods={"GET"})
 */
final class ListCustomerUserAction implements ListCustomerUserActionInterface
{

    /**
     * @var CustomerUserRepositoryInterface
     */
    private $customerUserRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        CustomerUserRepositoryInterface $customerUserRepository,
        TokenStorageInterface $tokenStorage
    ) {
        $this->customerUserRepository = $customerUserRepository;
        $this->tokenStorage           = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        ListCustomerUserResponderInterface $listCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response {

        $customerUsers = $this->customerUserRepository->findAllCustomerUser($this->tokenStorage->getToken()->getUser());

        if(\is_null($customerUsers)) {
            return $notFoundCustomerUserResponder();
        }

        return $listCustomerUserResponder($request, $customerUsers);
    }

}
