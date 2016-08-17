<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    private $user;
    
    public function __CONSTRUCT(){
        parent::__construct();
        
        $this->user = ['user' => RestApi::getUserData()];      
        
        if($this->user['user'] === null) redirect('');        
        $this->load->model('UsersModel', 'em');
    }
    
	public function index($p = 0){
        //header
		$this->load->view('header', $this->user);
        
        // Definimos unas variables para traer la data y mantener la lógica de paginación
        $limite = 10;
        $data   = [];
        $total  = 0;
        
        try{
            $result = $this->em->listar($limite, $p);
            $total  = $result->total;
            $data   = $result->data;
        } catch(Exception $e){

        }

        // Inicializando paginación
        $this->pagination->initialize(
            paginacion_config(
                site_url("Users/index"),
                $total,
                $limite
            )
        );

        $this->load->view('index', [
            'model' => $data
        ]);
        
        //footer
        $this->load->view('footer');
	}
    
	public function crud($id = 0){
        $data = null;
        
        if($id > 0) $data = $this->em->get($id);
        
		$this->load->view('header', $this->user);
        $this->load->view('crud', [
            'model' => $data
        ]);
        $this->load->view('footer');
	}
    
    public function save(){
        $errors = [];
        
        $id = $this->input->post('id');
        
        $data = [            
            'email'   => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'name'  => $this->input->post('name'),
            'last_name'   => $this->input->post('last_name'),
            'isAdmin'   => $this->input->post('isAdmin'),
            //'id_employee'   => $this->input->post('id_employee'),

        ];
        
        try{
            if(empty($id)){
                $this->em->insert($data);
            } else{
                if(empty($data['password'])) unset($data['password']);
                $this->em->update($data, $id);
            }            
        }catch(Exception $e){
            if($e->getMessage() === RestApiErrorCode::UNPROCESSABLE_ENTITY){
                $errors = RestApi::getEntityValidationFieldsError();
            }
        }

        if(count($errors) === 0) redirect('Users');
        else {
            $this->load->view('header', $this->user);
            $this->load->view('validation', [
                'errors' => $errors
            ]);
            $this->load->view('footer');
        }
    }    
    
    public function delete($id){
        $this->em->delete($id);
        redirect('Users');
    }
}