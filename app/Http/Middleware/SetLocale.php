<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('system_language', config('app.locale'));

        App::setLocale($locale);

        return $next($request);
    }
}
