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

namespace App\DoctrineListener;

use App\DoctrineListener\Interfaces\AddLinksDoctrineListenerInterface;
use App\Entity\CustomerUser;
use App\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AddLinksDoctrineListener.
 */
final class AddLinksDoctrineListener implements AddLinksDoctrineListenerInterface
{

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * {@inheritdoc}
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Product) {
            $product = $args->getEntity();
            $product->addLinks(['get' => ['href' => $this->urlGenerator->generate('product_show', array('id' => $product->getUid()))]]);
            $product->addLinks(['patch' => ['href' => $this->urlGenerator->generate('product_update', array('id' => $product->getUid()))]]);
            $product->addLinks(['delete' => ['href' => $this->urlGenerator->generate('product_delete', array('id' => $product->getUid()))]]);
        }

        if ($args->getEntity() instanceof CustomerUser) {
            $customerUser = $args->getEntity();
            $customerUser->addLinks(['get' => ['href' => $this->urlGenerator->generate('customer_user_show', array('id' => $customerUser->getUid()))]]);
            $customerUser->addLinks(['patch' => ['href' => $this->urlGenerator->generate('customer_user_update', array('id' => $customerUser->getUid()))]]);
            $customerUser->addLinks(['delete' => ['href' => $this->urlGenerator->generate('customer_user_delete', array('id' => $customerUser->getUid()))]]);
        }
    }
}
