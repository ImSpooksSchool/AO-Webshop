<?php
/**
 * Created by Nick on 18 May 2020.
 * Copyright © ImSpooks
 */


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserIsAdmin {

    public function handle($request, Closure $next) {
        if (!Auth::check() || !Auth::user()->hasRole("admin")) {
            return new RedirectResponse(url('/home'));
        }
        return $next($request);
    }
}
