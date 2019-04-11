<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CustomRedirectIfAuth
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth) 
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {

            $roles_arr = [];
            foreach($request->user()->userRoles as $roles){
                $roles_arr[] = $roles->role_id;
            }

        	if($request->user()->is_admin == 1){
        		return redirect('/admin/dashboard');
        	} elseif (in_array(1,$roles_arr)) {
                return redirect('/user/dashboard');
            } elseif (in_array(2,$roles_arr)) {
                return redirect('/consultant/dashboard');
            } else {
                return die('no role for current user (CustomRedirectIfAuth.php');
            } 
        }

        return $next($request); 
    }
}
