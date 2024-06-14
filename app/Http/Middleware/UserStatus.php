<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->status == 'active') {
            return $next($request);
        }
        else if (Auth::user()->status == 'ban') {
            return redirect()->back()->withErrors('Ваш аккаунт заблокирован. Права ограничены.');
        }
        else {
            return redirect()->back()->withErrors('Неизвестная ошибка.');
        }
        
    }
}
