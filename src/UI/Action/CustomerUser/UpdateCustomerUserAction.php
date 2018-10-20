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

use App\Entity\Product;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Action\CustomerUser\Interfaces\UpdateCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\ForbiddenCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\UpdateCustomerUserResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UpdateCustomerUserAction.
 *
 * @Route("api/customerUser/{id}", name="customer_user_update", methods={"PATCH"})
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     *{@inheritdoc}
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerUserRepositoryInterface $customerUserRepository,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    ) {
        $this->entityManager          = $entityManager;
        $this->customerUserRepository = $customerUserRepository;
        $this->validator              = $validator;
        $this->tokenStorage           = $tokenStorage;
    }

    /**
     *{@inheritdoc}
     */
    public function __invoke(
        Request $request,
        UpdateCustomerUserResponderInterface $updateCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder,
        ForbiddenCustomerUserResponderInterface $forbiddenCustomerUserResponder
    ): Response {

        $cache = new ApcuCache();

        $array = json_decode($request->getContent(), true);
        $products = $array['products'] ?? null;

        $customerUser = $this->customerUserRepository->findOneByUuidField($request->attributes->get('id'));

        if (\is_null($customerUser)) {
            return $notFoundCustomerUserResponder();
        }

        if($customerUser->getCustomer()->getUid()->toString()!==$this->tokenStorage->getToken()->getUser()->getUid()->toString())
        {
            return $forbiddenCustomerUserResponder();
        }

        if(!\is_null($products))
        {
            unset($array['products']);
            $customerUser->deleteProducts();
              foreach ($products as $product)
            {
                $product = $this->entityManager->getRepository(Product::class)->findOneByUuidField($product['uid']);
                if(!\is_null($product))
                {
                    $customerUser->addProduct($product);
                }
            }
        }

        $customerUser->updateCustomer($array);
        $errors = $this->validator->validate($customerUser);

        if (\count($errors) > 0) {
            return $updateCustomerUserResponder($request, $errors);
        }

        $cache->deleteAll();
        $this->entityManager->flush();

        return $updateCustomerUserResponder($request);
    }
}
