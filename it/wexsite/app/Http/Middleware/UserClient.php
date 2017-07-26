<?php
namespace App\Http\Middleware;

use Closure;
use Auth;

class UserClient
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
        $roles_arr = array();
        if (Auth::check()) {
            foreach($request->user()->userRoles as $roles){
                $roles_arr[] = $roles->role_id;
            }            
        	if(in_array(1,$roles_arr)){
        		return $next($request);
        	}
            return redirect('/');
        }
        return $next($request);
    }
}
