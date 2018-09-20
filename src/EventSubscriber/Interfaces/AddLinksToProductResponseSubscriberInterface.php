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

namespace App\EventSubscriber\Interfaces;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Interface AddLinksToProductResponseSubscriberInterface.
 */
interface AddLinksToProductResponseSubscriberInterface
{

    /**
     * AddLinksToProductResponseSubscriberInterface constructor.
     *
     * @param SerializerInterface $serializer
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param FilterResponseEvent $event
     *
     * @return void
     */
    public function addLinksOnGetMethods(FilterResponseEvent $event): void;
}
