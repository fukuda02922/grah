<?php

namespace App\Http\Middleware;


use Closure;

class CheckLogIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null(session('user_id'))) {
            return redirect('/customer/login')->with('flash_message', 'ログインを行ってください。');
        }

        return $next($request);
    }
}
