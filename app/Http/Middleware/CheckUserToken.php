<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Models\UserToken;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response|RedirectResponse) $next
     * @return mixed
     * @throws ApiException
     */
    public function handle(Request $request, Closure $next)
    {
        $exception = new ApiException('Авторизуйтесь', ApiException::UNAUTHORIZED, 401);

        $token = $request->bearerToken();
        $userToken = UserToken::firstWhere('token', $token);

        if (empty($token) || !$userToken){
            throw $exception;
        }

        $request->request->set('user', $userToken->load('user')->user);

        return $next($request);
    }
}
