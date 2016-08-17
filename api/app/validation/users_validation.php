<?php
namespace App\Validation;

use App\Lib\Response;

class UsersValidation {
    public static function validate($data) {
        $response = new Response();
        
        $key = 'name';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'This field is mandatory';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Minimun 4 characters';
            }
        }
        
        $key = 'last_name';
        if(empty($data[$key])){
            $response->errors[$key][] = 'This field is mandatory';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Minimun 4 characters';
            }
        }

        $key = 'email';
        if(empty($data[$key])){
            $response->errors[$key][] = 'This field is mandatory';
        } else {
            $value = $data[$key];
            
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $response->errors[$key][] = 'Must be a valid email';
            }
        }

        $key = 'password';
         if(empty($data[$key])){
            $response->errors[$key][] = 'This field is mandatory';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Minimun 4 characters';
            }
        }

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}