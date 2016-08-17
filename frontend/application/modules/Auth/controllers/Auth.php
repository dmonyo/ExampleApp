<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    private $user;
    public function __CONSTRUCT(){
        parent::__construct();

        $this->user = ['user' =>RestApi::getUserData()];
        
        $this->load->model('authmodel', 'am');
    }
    
	public function index(){

        if($this->user['user'] == null){
            $this->load->view('header');
            $this->load->view('auth/index.php');
            $this->load->view('footer');

        }
        else{
            redirect('Person', 'refresh');
        }
		
	}
    
    public function authenticate(){
        $error = '';
        
        $r = $this->am->authenticate(
            $this->input->post('email'),
            $this->input->post('password')
        );

        //var_dump($r);die;
        
        if($r->response){
            // Seteamos el token
            RestApi::setToken($r->result);
            
            // User
            $user = RestApi::getUserData();            

            redirect('Person', 'refresh');
            
            /*if($user->EsAdmin == 1) {
                redirect('empleado');
            } else {
                RestApi::destroyToken();
                $error = 'Sorry. You don't have admin privileges.';
            }*/
        } else {
            $error = $r->message;
            $this->load->view('header');
	        $this->load->view('auth/index.php', [
	            'error' => $error
	        ]);
	        $this->load->view('footer');

        }

        
       
    }
    
    public function logout(){
        RestApi::destroyToken();
        redirect('');
    }
}
