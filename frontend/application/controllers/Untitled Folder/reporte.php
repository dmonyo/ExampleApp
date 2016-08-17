<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {
    public function __CONSTRUCT(){
        parent::__construct();
    }
    
	public function top_empleado(){
		$this->load->view('header', test_header_data());
        $this->load->view('reporte/top_empleado');
        $this->load->view('footer');
	}
    
	public function top_producto(){
		$this->load->view('header', test_header_data());
        $this->load->view('reporte/top_producto');
        $this->load->view('footer');
	}
    
	public function venta_mensual(){
		$this->load->view('header', test_header_data());
        $this->load->view('reporte/venta_mensual');
        $this->load->view('footer');
	}
}
