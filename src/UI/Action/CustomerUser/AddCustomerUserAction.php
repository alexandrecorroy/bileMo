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

use App\Entity\CustomerUser;
use App\Entity\Product;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Action\CustomerUser\Interfaces\AddCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\AddCustomerUserResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddCustomerUserAction.
 * @Route("api/customerUser", name="customer_user_add", methods={"POST"})
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerUserRepositoryInterface $customerUserRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage,
        RouterInterface $router
    ) {
        $this->entityManager          = $entityManager;
        $this->customerUserRepository = $customerUserRepository;
        $this->serializer             = $serializer;
        $this->validator              = $validator;
        $this->tokenStorage           = $tokenStorage;
        $this->router                 = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        AddCustomerUserResponderInterface $addCustomerUserResponder
    ): Response {
        $cache = new ApcuCache();

        $data = $request->getContent();
        $products = json_decode($data, true)['products'] ?? null;

        $customer = $this->tokenStorage->getToken()->getUser();

        $customerUser = $this->serializer->deserialize($data, CustomerUser::class, 'json');

        $errors = $this->validator->validate($customerUser);

        if (\count($errors) > 0) {
            return $addCustomerUserResponder(Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, null,$errors);
        }

        if (!\is_null($this->customerUserRepository->findOtherCustomerUser($customerUser))) {
            return $addCustomerUserResponder(Response::HTTP_SEE_OTHER);
        }

        if(!\is_null($products))
        {
            foreach ($products as $product)
            {
                $product = $this->entityManager->getRepository(Product::class)->findOneByUuidField($product['uid']);
                if(!\is_null($product))
                {
                    $customerUser->addProduct($product);
                }
            }
        }

        $customer->addCustomerUser($customerUser);
        $this->entityManager->persist($customer);
        $cache->delete('findAllCustomerUser'.$customer->getUid()->toString());
        $this->entityManager->flush();

        return $addCustomerUserResponder(Response::HTTP_CREATED, $this->router->generate('customer_user_show', ['id' => $customerUser->getUid()->toString()]));
    }

}
