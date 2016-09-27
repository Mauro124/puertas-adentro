<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
	
	public function index()
	{
		$this->load->view('/layout/header');
		$this->load->view('/panel/top');
		$this->load->view('/panel/nav-bar-administrador');
		$this->load->view('/body/administrador');
		$this->load->view('/layout/footer-administrador');
	}
}
