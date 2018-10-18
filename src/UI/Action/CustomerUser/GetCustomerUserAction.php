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
use App\UI\Action\CustomerUser\Interfaces\GetCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\ForbiddenCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\GetCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * final Class GetCustomerUserAction.
 *
 * @Route("api/customerUser/{id}", name="customer_user_show", methods={"GET"})
 */
final class GetCustomerUserAction implements GetCustomerUserActionInterface
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
     * Delete a customerUser.
     *
     * You can delete one of your customerUsers.
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=403,
     *     description="Cannot view this customerUser"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="CustomerUser not found"
     * )
     * @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     type="string",
     *     default="Bearer TOKEN",
     *     description="Authorization"
     *)
     *@SWG\Parameter(
     *     name="id",
     *     in="path",
     *     dataType="string",
     *     description="uid of customerUser",
     *     required=true
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
        GetCustomerUserResponderInterface $getCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder,
        ForbiddenCustomerUserResponderInterface $forbiddenCustomerUserResponder
    ): Response {

        $customerUser = $this->customerUserRepository->findOneByUuidField($request->attributes->get('id'));

        if(\is_null($customerUser)) {
            return $notFoundCustomerUserResponder();
        }

        if($customerUser->getCustomer()->getUid()->toString()!==$this->tokenStorage->getToken()->getUser()->getUid()->toString())
        {
            return $forbiddenCustomerUserResponder();
        }

        return $getCustomerUserResponder($request, $customerUser);
    }
}
