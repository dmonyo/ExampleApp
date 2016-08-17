<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
    public function __CONSTRUCT(){
        parent::__construct();
    }
    
	public function index(){
		$this->load->view('header', test_header_data());
        $this->load->view('producto/index');
        $this->load->view('footer');
	}
    
	public function crud($id = 0){
		$this->load->view('header', test_header_data());
        $this->load->view('producto/crud');
        $this->load->view('footer');
	}
    
    public function guardar(){}    
    
    public function eliminar($id){}
}
