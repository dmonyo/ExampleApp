<?php
class AuthModel extends CI_Model{
    public function authenticate($correo, $password){

        //die($correo. ' '. $password);
        return RestApi::call(
            RestApiMethod::POST,
            "auth/authenticate",
            [
                'email' => $correo,
                'password' => $password,
            ]
        );
    }
}