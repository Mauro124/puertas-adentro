<?php
class Banner_modelo extends CI_Model {

  public function __construct() {
    $this->load->database();
    $this->load->model('modelo_basico');
  }

  public function cargarBanner($token){

    if($token){

      $usuario = $this -> modelo_basico -> getUsuario($token);

      if($usuario){

        $banner = $this -> modelo_basico -> obtenerObjetoJSON();

        if($banner){

          $imagen = $banner -> imagen;
          $ancho = $banner -> ancho;
          $alto = $banner -> alto;

          $nuevoBanner = array(
            'imagen' => $imagen,
            'ancho' => $ancho,
            'alto' => $alto,
          );

          $this -> db -> trans_begin();

          $this -> db -> where('id', 1);
          $this -> db -> update('Banner', $nuevoBanner);

          if ($this -> db-> trans_status() === FALSE) {

            $this -> db -> trans_rollback();
            $this -> modelo_basico -> generarRespuesta(500, 'Hubo problemas al actualizar el banner. La transaccion fue descartada.');

          } else {

           $this->db->trans_commit();
           $this -> modelo_basico -> generarRespuesta(200, 'OK');
          }

        } else {
          $this -> modelo_basico -> generarRespuesta(400, 'Nuevo banner incorrecto');
        }

      } else {
        $this -> modelo_basico -> generarRespuesta(401, 'No autorizado');
      }

    } else {
      $this -> modelo_basico -> generarRespuesta(401, 'No autorizado');
    }
  }

  public function obtenerBanner(){

    $resultado = $this -> db -> get('Banner');
    $this -> modelo_basico -> generarRespuestaJSON($resultado -> row());
  }
}
