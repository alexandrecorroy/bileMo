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
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Responder\CustomerUser\Interfaces\ForbiddenCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\UpdateCustomerUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface UpdateCustomerUserActionInterface.
 */
interface UpdateCustomerUserActionInterface
{
    /**
     * UpdateCustomerUserActionInterface constructor.
     *
     * @param CustomerUserRepositoryInterface $customerUserRepository
     * @param ValidatorInterface $validator
     * @param TokenStorageInterface $tokenStorage
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        CustomerUserRepositoryInterface $customerUserRepository,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage,
        ProductRepositoryInterface $productRepository
    );

    /**
     * @param Request $request
     * @param UpdateCustomerUserResponderInterface $updateCustomerUserResponder
     * @param NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
     * @param ForbiddenCustomerUserResponderInterface $forbiddenCustomerUserResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        UpdateCustomerUserResponderInterface $updateCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder,
        ForbiddenCustomerUserResponderInterface $forbiddenCustomerUserResponder
    ): Response;
}
