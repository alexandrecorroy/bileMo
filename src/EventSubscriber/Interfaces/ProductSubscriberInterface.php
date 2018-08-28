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


use App\Service\Interfaces\ReturnBlankParameterNameInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Interface ProductSubscriberInterface.
 */
interface ProductSubscriberInterface
{
    /**
     * ProductSubscriberInterface constructor.
     *
     * @param ReturnBlankParameterNameInterface $returnBlankParameterName
     */
    public function __construct(ReturnBlankParameterNameInterface $returnBlankParameterName);

    /**
     * @param GetResponseForExceptionEvent $event
     *
     * @return void
     */
    public function missingConstructorException(GetResponseForExceptionEvent $event): void;

}
