<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {//Проверка если пользователь не вошел в систему и попытается зайти на страницы которые не доступы не зарегистрированным пользователям, то его перенаправит на login
            return route('login');
        }
    }
}
