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
use Swagger\Annotations as SWG;
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
     *
     * List your customerUsers.
     *
     * You can view all your customerUsers.
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not customerUsers found, you must add customerUser first"
     * )
     * @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     type="string",
     *     default="Bearer TOKEN",
     *     description="Authorization"
     *)
     *@SWG\Response(
     *     response=401,
     *     description="Expired JWT Token | JWT Token not found | Invalid JWT Token",
     *)
     * @SWG\Tag(
     *     name="API"
     *     )
     *
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
