<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __CONSTRUCT(){
        parent::__construct();
    }
	public function index(){
		$this->load->view('header');
        $this->load->view('auth/index.php');
        $this->load->view('footer');
	}
}
