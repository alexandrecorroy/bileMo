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
use App\UI\Action\CustomerUser\Interfaces\UpdateCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\UpdateCustomerUserResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UpdateCustomerUserAction.
 *
 * @Route("/customerUser/{id}", name="customer_user_update", methods={"PATCH"})
 */
final class UpdateCustomerUserAction implements UpdateCustomerUserActionInterface
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
     * @var ValidatorInterface
     */
    private $validator;

    /**
     *{@inheritdoc}
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerUserRepositoryInterface $customerUserRepository,
        ValidatorInterface $validator
    ) {
        $this->entityManager     = $entityManager;
        $this->customerUserRepository = $customerUserRepository;
        $this->validator         = $validator;
    }

    /**
     *{@inheritdoc}
     */
    public function __invoke(
        Request $request,
        UpdateCustomerUserResponderInterface $updateCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response {

        $cache = new ApcuCache();

        $array = \json_decode($request->getContent(), true);

        $customerUser = $this->customerUserRepository->findOneByUuidField($request->attributes->get('id'));

        // check if Customer is own of customerUser

        if (\is_null($customerUser)) {
            return $notFoundCustomerUserResponder();
        }

        $customerUser->updateCustomer($array);

        $errors = $this->validator->validate($customerUser);

        if (\count($errors) > 0) {
            return $updateCustomerUserResponder($request, $errors);
        }

        $cache->delete('find'.$customerUser->getUid());
        $this->entityManager->flush();

        return $updateCustomerUserResponder($request);
    }
}
