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
use App\Entity\CustomerUser;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Action\CustomerUser\Interfaces\AddCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\AddCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddCustomerUserAction.
 * @Route("/customerUser", name="customer_user_add", methods={"POST"})
 */
final class AddCustomerUserAction implements AddCustomerUserActionInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CustomerUserRepositoryInterface
     */
    private $customerUserRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerUserRepositoryInterface $customerUserRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->customerUserRepository = $customerUserRepository;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        AddCustomerUserResponderInterface $addCustomerUserResponder
    ): Response {

        $data = $request->getContent();

        // start auto add uuid customer connected

        $repository = $this->entityManager->getRepository(Customer::class);

        $customer = $repository->getOneCustomer();

        // end auto add uuid customer connected

        $customerUser = $this->serializer->deserialize($data, CustomerUser::class, 'json', array('enable_max_depth' => true));

        $errors = $this->validator->validate($customerUser);

        if (\count($errors) > 0) {
            return $addCustomerUserResponder($request, $errors);
        }

        if ($this->customerUserRepository->findOtherCustomerUser($customerUser)) {
            return $addCustomerUserResponder($request, Response::HTTP_SEE_OTHER);
        }

        $customer->addCustomerUser($customerUser);
        $this->entityManager->persist($customer);
        $this->entityManager->flush();

        return $addCustomerUserResponder($request);
    }

}
