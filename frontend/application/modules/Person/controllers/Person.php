<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends MX_Controller {

    private $user;
    
    public function __CONSTRUCT(){
        parent::__construct();
        
        $this->user = ['user' => RestApi::getUserData()];      
        
        if($this->user['user'] === null) redirect('');        
        $this->load->model('PersonModel', 'pm');
    }
    
    public function index($p = 0){
        //header
        $this->load->view('header', $this->user);
        
        // Definimos unas variables para traer la data y mantener la lógica de paginación
        $limite = 10;
        $data   = [];
        $total  = 0;
        
        try{
            $result = $this->pm->listar($limite, $p);
            $total  = $result->total;
            $data   = $result->data;
        } catch(Exception $e){

        }

        // Inicializando paginación
        $this->pagination->initialize(
            paginacion_config(
                site_url("Person/index"),
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

    public function info($id){        
        
        $data = $this->pm->get($id);
        
        $this->load->view('header', $this->user);
        $this->load->view('info', [
            'model' => $data
        ]);
        $this->load->view('footer');

    }
    
    public function crud($id = 0){
        $data = null;
        
        if($id > 0) $data = $this->pm->get($id);
        
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
            
            'name'  => $this->input->post('name'),
            'last_name'   => $this->input->post('last_name'),
            'email'   => $this->input->post('email'),
            'id_number'   => $this->input->post('id_number'),
            'dob'   => $this->input->post('dob'),
            'address'   => $this->input->post('address'),
            'image'   => @encode_image_to_base64($_FILES['image']), 

        ];

                
        try{
            if(empty($id)){
                $this->pm->insert($data);
            } else{                
                $this->pm->update($data, $id);
            }            
        }catch(Exception $e){
            if($e->getMessage() === RestApiErrorCode::UNPROCESSABLE_ENTITY){
                $errors = RestApi::getEntityValidationFieldsError();
            }
        }

        if(count($errors) === 0) redirect('Person');
        else {
            $this->load->view('header', $this->user);
            $this->load->view('validation', [
                'errors' => $errors
            ]);
            $this->load->view('footer');
        }
    }    
    
    public function delete($id){
        $this->pm->delete($id);
        redirect('Person');
    }
}
