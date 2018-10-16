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

namespace App\UI\Action\Auth;

use App\Entity\Customer;
use App\Repository\Interfaces\CustomerRepositoryInterface;
use App\UI\Action\Auth\Interfaces\RegisterActionInterface;
use App\UI\Responder\Auth\Interfaces\RegisterResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * final Class RegisterAction
 * @Route("/api/register", name="api_register", methods={"POST"})
 */
final class RegisterAction implements RegisterActionInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepositoryInterface;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        SerializerInterface $serializer,
        UserPasswordEncoderInterface $encoder,
        ValidatorInterface $validator,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->serializer                  = $serializer;
        $this->encoder                     = $encoder;
        $this->validator                   = $validator;
        $this->customerRepositoryInterface = $customerRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        RegisterResponderInterface $responder
    ): Response {

        $data = $request->getContent();

        $customer = $this->serializer->deserialize($data, Customer::class, 'json');

        $errors = $this->validator->validate($customer);

        if(\count($errors) > 0)
        {
            return $responder(Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE, $errors);
        }

        $password = $this->encoder->encodePassword($customer, $customer->getPassword());
        $customer->updatePassword($password);

        $this->customerRepositoryInterface->create($customer);

        return $responder();
    }
}
