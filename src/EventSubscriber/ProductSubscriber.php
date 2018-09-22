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

use App\EventSubscriber\Interfaces\ProductSubscriberInterface;
use App\Service\Interfaces\ReturnBlankParameterNameInterface;
use App\Service\ReturnBlankParameterName;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;

/**
 * final Class ProductSubscriber.
 */
final class ProductSubscriber implements EventSubscriberInterface, ProductSubscriberInterface
{
    /**
     * @var ReturnBlankParameterName
     */
    private $returnBlankParameterName;

    /**
     * {@inheritdoc}
     */
    public function __construct(ReturnBlankParameterNameInterface $returnBlankParameterName)
    {
        $this->returnBlankParameterName = $returnBlankParameterName;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
            KernelEvents::EXCEPTION => 'missingConstructorException'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function missingConstructorException(GetResponseForExceptionEvent $event): void
    {
        if (!$event->getException() instanceof MissingConstructorArgumentsException) {
            return;
        }
        else {
            $param = $this->returnBlankParameterName->returnParameter($event->getException()->getMessage());

            $errorMessage = [
                'Message:' => 'Partial Content',
                'Detail' => $param.' parameter is required'
            ];

            $response = new JsonResponse($errorMessage, Response::HTTP_PARTIAL_CONTENT);
            $event->allowCustomResponseCode();

            $event->setResponse($response);
        }
    }
}
