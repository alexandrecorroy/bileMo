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

namespace App\UI\Action\Product\Interfaces;

use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Responder\Product\Interfaces\DeleteProductResponderInterface;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use App\UI\Responder\Product\NotFoundProductResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface DeleteProductActionInterface.
 */
interface DeleteProductActionInterface
{

    /**
     * DeleteProductActionInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ProductRepositoryInterface $productRepository
    );

    /**
     * @param Request $request
     * @param DeleteProductResponderInterface $deleteProductResponder
     * @param NotFoundProductResponderInterface $notFoundProductResponder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        DeleteProductResponderInterface $deleteProductResponder,
        NotFoundProductResponderInterface $notFoundProductResponder
    ): Response;
}
