<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resultado extends CI_Controller {
	
	public function index()
	{
		$this->load->view('/layout/header');
        $this->load->view('/panel/top');
		$this->load->view('/panel/nav-bar-resultado');
		$this->load->view('/body/resultado');
		$this->load->view('/layout/footer');
	}
}
