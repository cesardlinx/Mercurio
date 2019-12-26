<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locaciones_model extends CI_Model {

	// tabla a usar de la base de datos
  private static $tabla = 'admin_locaciones';
  private static $seccion = 'locaciones';


	public function __construct()
	{
		parent::__construct();
	}
  // ------------------------------------------------------------------------

  public function almacenar_mdl($datos) {
    $this->db->insert(self::$tabla, $datos);
  }

  // ------------------------------------------------------------------------

  public function obtener_datos($id) {
    $this->db->where("id", $id);
    $query = $this->db->get(self::$tabla);
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else
      return "Sin datos ($id)";
  }

  // ------------------------------------------------------------------------

  public function actualizar_mdl($id, $datos) {      
    $this->db->where('id', $id);
    $this->db->update(self::$tabla, $datos);
  }

  // ------------------------------------------------------------------------

  public function eliminar_mdl($id) {
    $this->db->where('id', $id);
    $this->db->delete(self::$tabla);
    return true;
  }

  // ------------------------------------------------------------------------

  public function combo_locaciones($id = '') {
    $html = "<select id='loc_id' name='loc_id'><option value=''>Seleccione</option>";
    $this->db->order_by("loc_nombre");
    $query = $this->db->get('admin_locaciones');
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $fila) {
        $id_d = $fila->id;
        $loc_nombre = $fila->loc_nombre;
        if ($id_d == $id)
          $selected = "selected";
        else
          $selected = "";
        $html.="<option value='$id_d' $selected>$loc_nombre</option>";
      }
      return $html . "</select>";
    } else
      return "No hay locaciones ingresados";
    return $html;
    }

  // ------------------------------------------------------------------------

  /*locaciones por página para la paginación*/
  public function locaciones_pagina($limit, $offset)
  {
    $this->db->order_by('id', 'asc');
    $this->db->limit($limit, $offset);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();
      
  }

  /*numero total de locaciones*/
  public function numero_locaciones()
  {
    $query = $this->db->get(self::$tabla);
    return $query->num_rows();
  }

  /*total de la busqueda de locaciones*/
  public function total_busqueda_locaciones ($busqueda)
  {

    $this->db->like('loc_nombre', $busqueda);
    $query = $this->db->get(self::$tabla);

    return $query->num_rows();
      
  }

  /*busqueda de locaciones por página*/
  public function buscar_locaciones_pag($busqueda, $limit, $offset)
  {
    $this->db->order_by('id', 'asc');        
    $this->db->limit($limit, $offset);
    $this->db->like('loc_nombre', $busqueda);
    $query = $this->db->get(self::$tabla);

    return $query->result_array();    
  }


}

