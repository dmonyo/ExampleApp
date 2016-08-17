<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Auth;

class AuthModel
{
    private $db;
    private $table = 'users';
    private $response;

    
    public function __CONSTRUCT($db)
    { 
       
        $this->db = $db;
        $this->response = new Response();
    }
    
    /*
    * function: authenticate
    * params: $email, $password
    * result: false, true + token generated
    */
    public function authenticate($email, $password) {
        $user = $this->db->from($this->table)                             
                             ->where('email', $email)
                             ->where('password', sha1($password))
                             ->fetch();
        
      
        
        if(is_object($user)){            
            
            $token = Auth::SignIn([
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'last_name' => $user->last_name,                  
            ]);


       

            
            $this->response->result = $token;
            
            return $this->response->SetResponse(true);
        }else{
            return $this->response->SetResponse(false, " Invalid Credentials ");
        }
    }

   


}