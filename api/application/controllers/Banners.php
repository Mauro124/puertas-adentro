<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('banner_modelo');
  }

  function index(){
    $this -> banner_modelo -> obtenerBanner();
  }

  function cargar($token){
    $this -> banner_modelo -> cargarBanner($token);
  }
}
