<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            $redirectUrl = urlencode($request->route()->getName());
            $queryParams = $request->query();
            return redirect()->route('admin.login', ["redir" => $redirectUrl, 'params' => http_build_query($queryParams)])->with(['error' => __('middleware.loginRequired')]);
        }

        return $next($request);
    }
}
