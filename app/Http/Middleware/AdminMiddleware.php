<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminMiddleware
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
        $user = User::all()->count();
        if(!($user == 1)) {
//            echo '<pre>';
//            var_dump(Auth::user());
//            echo '</pre>';
//            exit;
            if(!Auth::user()->hasPermissionTo('Administer-Roles-Permissions', 'web'))
            {
                abort('401');
            }
        }
        
        return $next($request);
    }
}
