<?php

/*
 * This file is part of AWS Cognito Auth solution.
 *
 * (c) EllaiSys <support@ellaisys.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ellaisys\Cognito\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Exception;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AwsCognitoAuthenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $module=null, $right=null)
    {
        if (auth()->guest()) {
            return response()->json(['error' => 'UNAUTHORIZED_REQUEST'], 401);
        } //End if

        $this->authenticate($request);
        return $next($request);
    } //Function ends

} //Class ends