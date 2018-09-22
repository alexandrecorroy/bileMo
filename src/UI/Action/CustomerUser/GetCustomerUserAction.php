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
use App\UI\Responder\CustomerUser\Interfaces\GetCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * final Class GetCustomerUserAction.
 *
 * @Route("/customerUser/{id}", name="customer_user_show", methods={"GET"})
 */
final class GetCustomerUserAction implements GetCustomerUserActionInterface
{
    /**
     * @var CustomerUserRepositoryInterface
     */
    private $customerUserRepository;

    /**
     * {@inheritdoc}
     */
    public function __construct(CustomerUserRepositoryInterface $customerUserRepository)
    {
        $this->customerUserRepository = $customerUserRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        GetCustomerUserResponderInterface $getCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response {

        $customerUser = $this->customerUserRepository->findOneByUuidField($request->attributes->get('id'));

        if(\is_null($customerUser)) {
            return $notFoundCustomerUserResponder();
        }

        return $getCustomerUserResponder($request, $customerUser);
    }
}
