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

namespace App\UI\Action\Auth\Interfaces;

use App\Repository\Interfaces\CustomerRepositoryInterface;
use App\UI\Responder\Auth\Interfaces\RegisterResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface RegisterActionInterface.
 */
interface RegisterActionInterface
{
    /**
     * RegisterActionInterface constructor.
     *
     * @param SerializerInterface $serializer
     * @param UserPasswordEncoderInterface $encoder
     * @param ValidatorInterface $validator
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        SerializerInterface $serializer,
        UserPasswordEncoderInterface $encoder,
        ValidatorInterface $validator,
        CustomerRepositoryInterface $customerRepository
    );

    /**
     * @param Request $request
     * @param RegisterResponderInterface $responder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        RegisterResponderInterface $responder
    ): Response;
}
