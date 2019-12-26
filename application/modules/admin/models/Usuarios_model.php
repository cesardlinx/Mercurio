<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

// tabla a usar de la base de datos
  private static $tabla = 'admin_usuarios';


  public function __construct()
  {
      parent::__construct();
  }


  // ------------------------------------------------------------------------

  public function almacenar_mdl($datos) {
    $this->db->insert(self::$tabla, $datos);
  }

  // ------------------------------------------------------------------------


  public function actualizar_mdl($id, $datos) {
        
    $this->db->where('id', $id);
    $this->db->update(self::$tabla, $datos);
  }

  // ------------------------------------------------------------------------

  public function datos_usuario($id) {
    $this->db->where("id", $id);
    $query = $this->db->get(self::$tabla);
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else
      return "Sin datos ($id)";
  }


  // ------------------------------------------------------------------------

  // no elimina sino desactiva al usuario
  public function eliminar_mdl($id) {
    $data = array(
        'usu_activo' => 'n'
    );
    $this->db->where('id', $id);
    $this->db->update(self::tabla, $data);
  }

  // ------------------------------------------------------------------------
  
  public function obtener_datos($data)
  {
    $query = $this->db->get_where(self::$tabla, $data);
    $resultado = $query->result_array();

    return $resultado;

  }
  // ------------------------------------------------------------------------

  public function combo_usuarios_mdl($usu_id = '', $w_buscar = '', $name = 'usu_id') {
    $select = "<select name='$name' id='$name' class='chosen-select'><option value=''>Usuarios:</option>";
    if ($w_buscar == "")
       $sql = "SELECT * FROM admin_usuarios WHERE `usu_activo`='s' ORDER BY `usu_nombres` LIMIT 0,10";
    else {
          $campos = "`usu_nombres`,`usu_apellidos`,`usu_email`";
          $where = "WHERE MATCH ($campos) AGAINST ('$w_buscar' IN BOOLEAN MODE)";
          $order_by = "ORDER BY `puntos` DESC";
          $sql = "SELECT *, MATCH($campos) AGAINST ('$w_buscar') AS 'puntos' from `admin_usuarios` $where AND `usu_activo`='s' $order_by LIMIT 0,10";
    }
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $fila) {
        if ($fila->id == $usu_id)
          $selected = "selected";
        else
          $selected = "";
          $select.="<option value='$fila->id' $selected>" . nomApeUsuario($fila->id) . "</option>";
      }
    }
    $select.="</select>";
    return $select;
  }

  // ------------------------------------------------------------------------

  /*usuarios por página para la paginación*/
  public function usuarios_pagina($limit, $offset)
  {
    $this->db->order_by('id', 'asc');
    $this->db->limit($limit, $offset);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();
      
  }

  /*numero total de usuarios*/
  public function numero_usuarios()
  {
    $query = $this->db->get(self::$tabla);
    return $query->num_rows();
  }

  /*total de la busqueda de usuarios*/
  public function total_busqueda_usuarios ($busqueda)
  {

    $this->db->like('usu_nombres', $busqueda);
    $this->db->or_like('usu_apellidos', $busqueda);
    $query = $this->db->get(self::$tabla);

    return $query->num_rows();
      
  }

  /*busqueda de usuarios por página*/
  public function buscar_usuarios_pag($busqueda, $limit, $offset)
  {
    $this->db->order_by('id', 'asc');        
    $this->db->limit($limit, $offset);
    $this->db->like('usu_nombres', $busqueda);
    $this->db->or_like('usu_apellidos', $busqueda);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();
    
  }

}
