<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class Authentication
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
        // if($request->input('age')<2)
        // {
        //   return redirect('/');
        // }
        // else {
        //   echo "test";
        // }
        $path = $request->path();
        if(\Auth::check())
        {
            return $next($request);
        }
        else
        {
            return redirect('/');
        }

    }
}
