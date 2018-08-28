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

namespace App\EventSubscriber;

use App\Entity\Product;
use App\EventSubscriber\Interfaces\AddLinksToProductResponseSubscriberInterface;
use App\Service\Interfaces\ReturnBlankParameterNameInterface;
use App\UI\Action\Product\GetProductAction;
use App\UI\Action\Product\ListProductAction;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * final Class AddLinksToResponseSubscriber.
 */
final class AddLinksToProductResponseSubscriber implements EventSubscriberInterface, AddLinksToProductResponseSubscriberInterface
{

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->serializer = $serializer;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::RESPONSE => 'addLinksOnGetMethods'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function addLinksOnGetMethods(FilterResponseEvent $event): void
    {
        if ($event->getRequest()->getMethod() !== 'GET') {
            return;
        }

        if ($event->getRequest()->get('_controller') === GetProductAction::class || ListProductAction::class) {
            $json = $event->getResponse()->getContent();

            $array = \json_decode($json);

            if (\count($array) > 1) {
                $products = [];
                foreach ($array as $product) {
                    $json = \json_encode($product);
                    $product = $this->serializer->deserialize($json, Product::class, 'json');

                    $product->addLinks(['get' => ['href' => $this->urlGenerator->generate('product_show', array('id' => $product->getUid()))]]);
                    $product->addLinks(['patch' => ['href' => $this->urlGenerator->generate('product_update', array('id' => $product->getUid()))]]);
                    $product->addLinks(['delete' => ['href' => $this->urlGenerator->generate('product_delete', array('id' => $product->getUid()))]]);

                    $products[] = $product;
                }

                $response = new JsonResponse($products);
                $event->setResponse($response);
            } else {
                $product = $this->serializer->deserialize($json, Product::class, 'json');

                $product->addLinks(['get' => ['href' => $this->urlGenerator->generate('product_show', array('id' => $product->getUid()))]]);
                $product->addLinks(['patch' => ['href' => $this->urlGenerator->generate('product_update', array('id' => $product->getUid()))]]);
                $product->addLinks(['delete' => ['href' => $this->urlGenerator->generate('product_delete', array('id' => $product->getUid()))]]);

                $response = new JsonResponse($product);
                $event->setResponse($response);
            }
        }
    }
}
