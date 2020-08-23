<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class issuper
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
    
        if($request->User()->api_token!=null){
        $user=User::where('api_token','=', $request->User()->api_token)->first();
            if($user!=null && $user->is_admin==1) return $next($request);
        }
        else abort(404);
    }
 }
