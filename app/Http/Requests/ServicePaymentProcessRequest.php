<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Auth;

class ServicePaymentProcessRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'pan' => 'required|max:40',  // fiscal code  
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required|max:10',
            'zip_code' => 'required',
            'tos' => 'required',
        ];

        if(!Auth::check()) {
            
            if($this->alreadyRegisteredUser()) {
                $rules['email'] = 'required|email|max:255';
                $rules['password'] = 'required';
            } else {
                $rules['email'] = 'required|email|max:255|unique:users';
                $rules['password'] = 'required|confirmed|min:6';
            }
        }

        return $rules;
    }

    public function messages() {
        return [
            'pan.required' => 'Fiscal Code field is required.',
            'password.required' => 'Password is required. Please <b>Check Email</b> to proceed.'
        ];
    }

    /**
     *
     * @return obj | null
     */
    public function alreadyRegisteredUser() {
        if($this->get('email')) {
            return User::where('email', $this->get('email'))->where('is_admin', false)->first() ?? null;
        }
        return null;
    }
}
