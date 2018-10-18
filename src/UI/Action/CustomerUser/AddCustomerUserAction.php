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
use App\Repository\Interfaces\CustomerRepositoryInterface;
use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Action\CustomerUser\Interfaces\AddCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\AddCustomerUserResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Swagger\Annotations as SWG;
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
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var CustomerUserRepositoryInterface
     */
    private $customerUserRepository;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

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
        ProductRepositoryInterface $productRepository,
        CustomerRepositoryInterface $customerRepository,
        CustomerUserRepositoryInterface $customerUserRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage,
        RouterInterface $router
    ) {
        $this->productRepository      = $productRepository;
        $this->customerRepository     = $customerRepository;
        $this->customerUserRepository = $customerUserRepository;
        $this->serializer             = $serializer;
        $this->validator              = $validator;
        $this->tokenStorage           = $tokenStorage;
        $this->router                 = $router;
    }

    /**
     *
     * Add a new customerUser.
     *
     * You can add a new customerUser and his products.
     *
     * @SWG\Response(
     *     response=201,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=303,
     *     description="When resources already exist"
     * )
     * @SWG\Response(
     *     response=416,
     *     description="When Range not satisfiable"
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
     *     name="body",
     *     in="body",
     *     description="json order object",
     *     required=true,
     *     format="application/json",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="name", type="string", example="Jones"),
     *         @SWG\Property(property="firstName", type="string", example="Bob"),
     *         @SWG\Property(property="email", type="string", example="jones.bob@gmail.com"),
     *         @SWG\Property(property="address", type="string", example="1 Mayfair - London"),
     *         @SWG\Property(property="zip", type="string", example="232323"),
     *         @SWG\Property(property="phone", type="string", example="34343243243", required="false"),
     *         @SWG\Property(
     *              property="products",
     *              type="array",
     *              @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="uid", type="string", example="656eebd8-38aa-4666-9f9b-24f3cb09ac38", required="false")
     *              ))
     *
     *)
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
                $product = $this->productRepository->findOneByUuidField($product['uid']);
                if(!\is_null($product))
                {
                    $customerUser->addProduct($product);
                }
            }
        }

        $customer->addCustomerUser($customerUser);
        $cache->delete('findAllCustomerUser'.$customer->getUid()->toString());
        $this->customerRepository->create($customer);

        return $addCustomerUserResponder(Response::HTTP_CREATED, $this->router->generate('customer_user_show', ['id' => $customerUser->getUid()->toString()]));
    }

}
