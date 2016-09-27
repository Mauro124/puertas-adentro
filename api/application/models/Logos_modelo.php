<?php
class Logos_modelo extends CI_Model {

  public function __construct() {
    $this->load->database();
    $this->load->model('modelo_basico');
  }

  public function cargarNuevosLogos($token){

    if($token){

      $usuario = $this -> modelo_basico -> getUsuario($token);

      if($usuario){

        $logos = $this -> modelo_basico -> obtenerObjetoJSON();

        if($logos){

          foreach ($logos as $logo) {

            $link = $logo -> link;
            $imagenBase64 = $logo -> imagen;
            $destacado = $logo -> destacado;
            $nombre = $logo -> nombre;
            $oculto = $logo -> oculto;
            $posicion = $logo -> posicion;

            $datos = array(
              'link' => $link,
              'imagen' => $imagenBase64,
              'destacado' => $destacado,
              'nombre' => $nombre,
              'oculto' => $oculto,
              'posicion' => $posicion
            );

            // Ya existe un logo con ese nombre?

            $this -> db -> where('nombre', $nombre);
            $logo = $this -> db -> get('Logo') -> row();

            if($logo == null){

              $this -> db -> trans_begin();

              $this -> db -> insert('Logo', $datos);

              if ($this -> db-> trans_status() === FALSE) {

                $this -> db -> trans_rollback();
                $this -> modelo_basico -> generarRespuesta(500, 'Hubo problemas al agregar el logo. La transaccion fue descartada.');

              } else {

               $this->db->trans_commit();
               $this -> modelo_basico -> generarRespuesta(200, 'OK');
              }

            } else {

              $this -> db -> trans_begin();

              $this -> db -> where('nombre', $nombre);
              $this -> db -> update('Logo', $datos);

              if ($this -> db-> trans_status() === FALSE) {

                $this -> db -> trans_rollback();
                $this -> modelo_basico -> generarRespuesta(500, 'Hubo problemas al actualizar el logo. La transaccion fue descartada.');

              } else {

               $this->db->trans_commit();
               $this -> modelo_basico -> generarRespuesta(200, 'OK');
              }
            }
          }
        } else {
          $this -> modelo_basico -> generarRespuesta(400, 'Logo incorrecto');
        }
      } else {
        $this -> modelo_basico -> generarRespuesta(401, 'No autorizado');
      }

    } else {
      $this -> modelo_basico -> generarRespuesta(401, 'No autorizado');
    }
  }

  public function obtenerLogos(){

    $this -> db -> order_by('posicion', 'ASC');
    $query = $this -> db -> get('Logo');
    $this -> modelo_basico -> generarRespuestaJSON($query -> result());
  }

  public function eliminarLogo($token){

    if($token){

      $usuario = $this -> modelo_basico -> getUsuario($token);

      if($usuario){

        $idLogos = $this -> modelo_basico -> obtenerObjetoJSON();

        if($idLogos){

          foreach ($idLogos as $logo) {

            $this -> db -> trans_begin();

            $this -> db -> where('nombre', $logo -> nombre);
            $query = $this -> db -> delete('Logo');

            if ($this -> db-> trans_status() === FALSE) {

              $this -> db -> trans_rollback();
              $this -> modelo_basico -> generarRespuesta(500, 'Hubo problemas al eliminar el logo. La transaccion fue descartada.');

            } else {

             $this->db->trans_commit();
             $this -> modelo_basico -> generarRespuesta(200, 'OK');
            }
          }
        } else {
          $this -> modelo_basico -> generarRespuesta(400, 'Se requiere nombre de logo');
        }
      } else {
        $this -> modelo_basico -> generarRespuesta(401, 'No autorizado');
      }
    } else {
      $this -> modelo_basico -> generarRespuesta(401, 'No autorizado');
    }
  }

  public function buscarLogo(){

    $nombre = $this -> input -> get('nombre');

    if($nombre){

      $this->db->like('nombre', $nombre);
      $resultado = $this -> db -> get('Logo');
      $this -> modelo_basico -> generarRespuestaJSON($resultado -> result());
    }
  }
}
