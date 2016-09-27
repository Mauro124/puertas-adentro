<?php
class Modelo_basico extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function obtenerObjetoJSON(){
    return json_decode(file_get_contents('php://input'));
  }

  public function generarRespuesta($codigo, $respuesta){
    $this->output->set_status_header($codigo)->set_output($respuesta);
  }

  public function generarRespuestaJSON($respuesta){
    $this -> output -> set_content_type('application/json') -> set_output(json_encode($respuesta));
  }

  public function getUsuario($token){

    $this -> db -> where('access_token', $token);
    $usuario = $this -> db -> get('Usuario') -> row();

    return $usuario;
  }

}
