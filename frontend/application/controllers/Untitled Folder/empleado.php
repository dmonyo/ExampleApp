<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado extends CI_Controller {
    public function __CONSTRUCT(){
        parent::__construct();
    }
    
	public function index(){
		$this->load->view('header', test_header_data());
        $this->load->view('empleado/index');
        $this->load->view('footer');
	}
    
	public function crud($id = 0){
		$this->load->view('header', test_header_data());
        $this->load->view('empleado/crud');
        $this->load->view('footer');
	}
    
    public function guardar(){}    
    
    public function eliminar($id){}
}
