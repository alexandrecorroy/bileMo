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

namespace App\UI\Action\Auth;

use App\UI\Action\Auth\Interfaces\ApiActionInterface;
use App\UI\Responder\Auth\Interfaces\ApiResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiAction.
 * @Route("/api", name="api", methods={"GET"})
 */
class ApiAction implements ApiActionInterface
{

    public function __invoke(ApiResponderInterface $loginResponder): Response
    {
        return $loginResponder();
    }

}
