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
use App\UI\Action\Product\Interfaces\UpdateProductActionInterface;
use App\UI\Responder\Product\Interfaces\UpdateProductResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UpdateProductAction.
 */
final class UpdateProductAction implements UpdateProductActionInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     *{@inheritdoc}
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     *{@inheritdoc}
     */
    public function __invoke(Request $request, UpdateProductResponderInterface $updateProductResponder): Response
    {
        // TODO: Implement __invoke() method.
    }
}
