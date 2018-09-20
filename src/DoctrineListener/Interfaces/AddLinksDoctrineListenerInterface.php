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

namespace App\DoctrineListener\Interfaces;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Interface AddLinksDoctrineListenerInterface.
 */
interface AddLinksDoctrineListenerInterface
{

    /**
     * AddLinksDoctrineListenerInterface constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator);

    /**
     * @param LifecycleEventArgs $args
     * @return mixed
     */
    public function postLoad(LifecycleEventArgs $args);

}
