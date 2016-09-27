<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Logos extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('logos_modelo');
  }

  function index(){
    $this -> logos_modelo -> obtenerLogos();
  }

  function guardar($token){
    $this -> logos_modelo -> cargarNuevosLogos($token);
  }

  function eliminar($token){
    $this -> logos_modelo -> eliminarLogo($token);
  }

  function buscar(){
    $this -> logos_modelo -> buscarLogo();
  }
}
