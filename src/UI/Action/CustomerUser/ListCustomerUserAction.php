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

use App\Entity\Customer;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Action\CustomerUser\Interfaces\ListCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\ListCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * final Class ListCustomerUserAction.
 *
 * @Route("/customerUsers", name="customer_user_list", methods={"GET"})
 */
final class ListCustomerUserAction implements ListCustomerUserActionInterface
{

    /**
     * @var CustomerUserRepositoryInterface
     */
    private $customerUserRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        CustomerUserRepositoryInterface $customerUserRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->customerUserRepository = $customerUserRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        ListCustomerUserResponderInterface $listCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response {

        // start auto add uuid customer connected

        $repository = $this->entityManager->getRepository(Customer::class);

        $customer = $repository->getOneCustomer();

        // end auto add uuid customer connected

        $customerUsers = $this->customerUserRepository->findAllCustomerUser($customer);

        if(\is_null($customerUsers)) {
            return $notFoundCustomerUserResponder();
        }

        return $listCustomerUserResponder($request, $customerUsers);
    }

}
