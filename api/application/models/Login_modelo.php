<?php
class Login_modelo extends CI_Model {

  public function __construct() {
    $this->load->database();
    $this->load->model('modelo_basico');
  }

  public function login(){

    $usuario = $this -> modelo_basico -> obtenerObjetoJSON();

    if(($usuario -> usuario) != null && ($usuario -> password) != null){

      $nombreUsuario = $usuario -> usuario;
      $password = $usuario -> password;

      $this->db->where(array('usuario' => $nombreUsuario, 'password' => $password));
      $usuario = $this -> db -> get('Usuario') -> row();

      if($usuario != null){

        $access_token = md5(uniqid(rand(), true));

        $this -> db -> where('usuario', $nombreUsuario);
        $this -> db -> update('Usuario', array('access_token' => $access_token));

        $this -> modelo_basico -> generarRespuestaJSON($access_token);
        
      } else {
        $this -> modelo_basico -> generarRespuesta(401, 'Usuario no autorizado');
      }

    } else {
      $this -> modelo_basico -> generarRespuesta(400, 'Campos incompletos');
    }
  }
}
