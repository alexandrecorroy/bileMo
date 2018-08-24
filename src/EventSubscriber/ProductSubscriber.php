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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;

/**
 * final Class ProductSubscriber.
 */
final class ProductSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::EXCEPTION => 'MissingConstructorException'
        );
    }

    /**
     * @param GetResponseForExceptionEvent $event
     *
     * @return null|Response
     */
    public function MissingConstructorException(GetResponseForExceptionEvent $event): ?Response
    {
        if ($event->getException() instanceof MissingConstructorArgumentsException) {
            $response = new JsonResponse('Partial Content', Response::HTTP_PARTIAL_CONTENT);
            $event->allowCustomResponseCode();

            return $event->setResponse($response);
        }
        return null;
    }
}
