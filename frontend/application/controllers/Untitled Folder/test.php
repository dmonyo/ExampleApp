<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function __CONSTRUCT(){
        parent::__CONSTRUCT();
        $this->load->model('TestModel', 'tm');
    }
    
    // Model test
	public function employee_index($p = 0){
        //header
		$this->load->view('header', test_header_data());
        
        $limite = 10;
        $data = [];
        $total  = 0;
        
        try{
            $result = $this->tm->getAll($limite, $p);
            $total  = $result->total;
            $data   = $result->data;
        } catch(Exception $e){
            var_dump($e);
        }

        $this->pagination->initialize(
            paginacion_config(
                site_url("test/employee_index"),
                $total,
                $limite
            )
        );

        $this->load->view('test/employee_index.php', [
            'model' => $data
        ]);
        
        //footer
        $this->load->view('footer');
	}
    
    public function employee_insert(){
        if(!empty($this->input->post('Nombre'))){
            $req = [
                'Nombre'    => $this->input->post('Nombre'),
                'Correo'    => $this->input->post('Correo'),
                'Password'  => $this->input->post('Nombre'),
                'Imagen'    => encode_image_to_base64(@$_FILES['File']),
            ];
            
            $this->tm->insert($req);
            redirect('test/employee_index');
        } else {
            $this->load->view('header', test_header_data());            
            $this->load->view('test/employee_insert');
            $this->load->view('footer');         
        }
    }
    
    // Convert image to base64
    public function image_to_base_64(){
        $img = encode_image_to_base64(@$_FILES['file']);        
        echo "<img src='$img' />";
    }
    
    // Token Auth Test
    public function token_auth(){
        $token = RestApi::call(
            RestApiMethod::GET,
            "test/auth"
        );
        
        RestApi::setToken($token);
        
        redirect('test/token_validate');
    }
    
    public function token_validate(){
        $r = RestApi::call(
            RestApiMethod::GET,
            "test/auth/validate"
        );
        
        var_dump($r);
    }
    
    public function token_get_user_data(){
        var_dump(RestApi::getUserData());
    }
    
    public function token_destroy(){
        RestApi::destroyToken();
        redirect('test/token_validate');
    }
    
    // Validation Test
    public function entity_validation(){
        try{
            $result = RestApi::call(
                RestApiMethod::POST,
                "test/valida"
            );

            var_dump($result);            
        } catch (Exception $e){
            if($e->getMessage() === RestApiErrorCode::UNPROCESSABLE_ENTITY){
                var_dump(RestApi::$errors);
            }
        }
    }
}
