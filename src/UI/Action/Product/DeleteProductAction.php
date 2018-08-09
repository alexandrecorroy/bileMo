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

use App\Entity\Product;
use App\UI\Action\Product\Interfaces\DeleteProductActionInterface;
use App\UI\Responder\Product\Interfaces\DeleteProductResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * final Class DeleteProductAction.
 *
 * @Route("/product/delete/{id}", name="product_delete", methods={"GET"})
 */
final class DeleteProductAction implements DeleteProductActionInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(Request $request, DeleteProductResponderInterface $deleteProductResponder): Response
    {
        $em = $this->entityManager;

        $product = $em->getRepository(Product::class)->findOneByUuidField($request->get("id"));

        $em->remove($product);
        $em->flush();

        return $deleteProductResponder($request);
    }
}
