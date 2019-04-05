<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RedirectToUserProfile
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
        if ( Auth::check() )
        {
			foreach($request->user()->userRoles as $roles){
                $roles_arr[] = $roles->role_id;
            }            
        	if(in_array(1,$roles_arr) && $request->user()->is_profile_complete == 1){
        		return $next($request);
        	}
            return redirect('user/profile/edit')->with('status', 'Please complete your profile!');
        }

        return redirect('/login');
    }
}
