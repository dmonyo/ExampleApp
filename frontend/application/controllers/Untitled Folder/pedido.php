<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {
    public function __CONSTRUCT(){
        parent::__construct();
    }
    
	public function index(){
		$this->load->view('header', test_header_data());
        $this->load->view('pedido/index');
        $this->load->view('footer');
	}
    
	public function ver($id){
		$this->load->view('header', test_header_data());
        $this->load->view('pedido/ver');
        $this->load->view('footer');
	}
}
