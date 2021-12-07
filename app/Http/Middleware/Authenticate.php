<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        
        // if($request->segment(1) == 'administration-dashboard'){
        //     return route('admin.login');
        // }

       // dd(auth()->guest());

        
        if (! $request->expectsJson()) {
            return route('web.site.home');
        }
    }
}
