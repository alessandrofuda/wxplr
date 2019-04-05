<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

    public function lists(Request $request, $token){

    	// https://www.wexplore.co/en/api/users/list/adkjhfVTkhvkjhdsjkhFvjzAxhvsdkufPhas




    	if($token && $token === 'adkjhfVTkhvkjhdsjkhFvjzAxhvsdkufPhas'){

	        $users = User::with(['userProfile', 'userAddresses'])->get();   //

        	return response()->json($users);

        } else {
        	return response()->json(['Response' => 'Not Authorized']);
        }

    }
    

}
