<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomBaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends CustomBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct() {   
        parent::__construct();
        $this->middleware('guest');
    }



    public function getEmail(){
        return view('auth.reset');
    }

    public function postReset(Request $request){
        
        dd($request);

        return 'ok';
    }
}
