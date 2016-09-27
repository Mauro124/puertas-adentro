<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('login_modelo');
  }

  function index(){
    $this -> login_modelo -> login();
  }
}
