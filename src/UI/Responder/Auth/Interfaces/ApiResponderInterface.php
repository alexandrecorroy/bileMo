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

namespace App\UI\Responder\Auth\Interfaces;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Interface ApiResponderInterface
 * @package App\UI\Responder\Auth\Interfaces
 */
interface ApiResponderInterface
{
    /**
     * ApiResponderInterface constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage);

    /**
     * @return mixed
     */
    public function __invoke(): Response;
}
