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
use Swagger\Annotations as SWG;

/**
 * Class ApiAction.
 * @Route("/api", name="api", methods={"GET"})
 */
class ApiAction implements ApiActionInterface
{

    /**
     *
     * Test if your are logged.
     *
     * You can test here if you are correctly logged !
     * Path to login : ^/api/login_check
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returned when successful"
     * )
     * @SWG\Response(
     *     response=303,
     *     description="When resources already exist"
     * )
     * @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     type="string",
     *     default="Bearer TOKEN",
     *     description="Authorization"
     *)
     *@SWG\Response(
     *     response=401,
     *     description="Expired JWT Token | JWT Token not found | Invalid JWT Token",
     *)
     * @SWG\Tag(
     *     name="API"
     *     )
     *
     * {@inheritdoc}
     */
    public function __invoke(ApiResponderInterface $loginResponder): Response
    {
        return $loginResponder();
    }

}
