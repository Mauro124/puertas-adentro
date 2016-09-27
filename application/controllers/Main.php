<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function index()
	{
		$this->load->view('/layout/header');
        $this->load->view('/panel/top');
		$this->load->view('/panel/nav-bar');
		$this->load->view('/body/main');
		$this->load->view('/layout/footer');
	}
}
