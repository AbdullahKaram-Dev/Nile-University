<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\Startup;
use Closure;

class BlockedStartup
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('web')->check() && !Startup::where('user_id',auth()->user()->id)->first()->value('status')){
            return  response()->view('user.startup.blocked');
        }
        return $next($request);
    }
}
