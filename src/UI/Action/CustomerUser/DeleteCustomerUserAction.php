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
use App\UI\Action\CustomerUser\Interfaces\DeleteCustomerUserActionInterface;
use App\UI\Responder\CustomerUser\Interfaces\DeleteCustomerUserResponderInterface;
use App\UI\Responder\CustomerUser\Interfaces\NotFoundCustomerUserResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteCustomerUserAction.
 *
 * @Route("/customer_user/{id}", name="customer_user_delete", methods={"DELETE"})
 */
final class DeleteCustomerUserAction implements DeleteCustomerUserActionInterface
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
    public function __construct(EntityManagerInterface $entityManager, CustomerUserRepositoryInterface $customerUserRepository)
    {
        $this->entityManager = $entityManager;
        $this->customerUserRepository = $customerUserRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        DeleteCustomerUserResponderInterface $deleteCustomerUserResponder,
        NotFoundCustomerUserResponderInterface $notFoundCustomerUserResponder
    ): Response {

        $cache = new ApcuCache();

        $customerUser = $this->customerUserRepository->findOneByUuidField($request->get("id"));

        if(\is_null($customerUser))
        {
            return $notFoundCustomerUserResponder();
        }

        $cache->delete('find'.$customerUser->getUid());
        $this->entityManager->remove($customerUser);
        $this->entityManager->flush();

        return $deleteCustomerUserResponder($request);
    }
}
