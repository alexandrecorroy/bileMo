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

namespace App\UI\Action\CustomerUser\Interfaces;

use App\Repository\Interfaces\CustomerUserRepositoryInterface;
use App\UI\Responder\CustomerUser\Interfaces\AddCustomerUserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface AddCustomerUserActionInterface.
 */
interface AddCustomerUserActionInterface
{

    /**
     * AddCustomerUserActionInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param CustomerUserRepositoryInterface $customerUserRepository
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerUserRepositoryInterface $customerUserRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    );

    /**
     * @param Request $request
     * @param AddCustomerUserResponderInterface $addCustomerUserResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        AddCustomerUserResponderInterface $addCustomerUserResponder
    ): Response;
}
