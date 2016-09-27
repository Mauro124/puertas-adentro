<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		$this->load->view('/layout/header');
		$this->load->view('/panel/top');
		$this->load->view('/body/login');
	}
}
