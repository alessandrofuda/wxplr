<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' = 'required|max:255',
            'surname' ='required|max:255',
            'pan' => 'required|max:40',  // fiscal code  
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required|max:10',
            'zip_code' => 'required',
            'tos' => 'required',
        ];

        if(!Auth::check()) {
            $rules['email'] = 'required|email|max:255|unique:users';
            
            if($this->alreadyRegisteredUser()) {
                $rules['password'] => 'required';
            } else {
                $rules['password'] => 'required|confirmed|min:6';
            }
        }

        return $rules;
    }

    public function messages() {
        return [
            'pan.required' => 'Fiscal Code field is required.'
        ];
    }

    /**
     *
     * @return bool
     */
    public function alreadyRegisteredUser() {
        // TO DO
    }
}
