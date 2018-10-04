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

namespace App\UI\Action\Product;

use App\Repository\Interfaces\ProductRepositoryInterface;
use App\UI\Action\Product\Interfaces\DeleteProductActionInterface;
use App\UI\Responder\Product\Interfaces\DeleteProductResponderInterface;
use App\UI\Responder\Product\Interfaces\NotFoundProductResponderInterface;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * final Class DeleteProductAction.
 *
 * @Route("api/product/{id}", name="product_delete", methods={"DELETE"})
 */
final class DeleteProductAction implements DeleteProductActionInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $productRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $entityManager, ProductRepositoryInterface $productRepository)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        DeleteProductResponderInterface $deleteProductResponder,
        NotFoundProductResponderInterface $notFoundProductResponder
    ): Response {

        $cache = new ApcuCache();
        $product = $this->productRepository->findOneByUuidField($request->get("id"));

        if(\is_null($product))
        {
            return $notFoundProductResponder();
        }

        $cache->delete('find'.$product->getUid());
        $this->entityManager->remove($product);
        $this->entityManager->flush();

        return $deleteProductResponder($request);
    }
}
