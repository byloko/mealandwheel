<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminMiddleware
{
  
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect(url('admin/login'));
            }
        } else {
            Auth::logout();
            return redirect(url('admin/login'));
        }
    }
}
